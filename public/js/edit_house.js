$(document).ready(function(){
    $("#select_category option:checked").each(function(){
        var house_id = $("#house_id").val();
        var category_id = $("#select_category option:checked").val();
        $.ajax({
            type: 'GET',
            url: site+'/json_propriete/'+house_id+'/'+category_id,
            dataType: "json",
            data: "",
            success: function(data) {
                console.log(data);
                var idArr = [];
                for (j in data.valArray){
                    idArr.push(data.valArray[j].propriete_id);
                }                
                for (i in data.proprietes) {
                    console.log(data.proprietes[i]);
                    console.log('idArr', idArr);
                    if (idArr.indexOf(data.proprietes[i].id) !== -1) {
                        $( ".proprietes" ).append(`
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="${data.proprietes[i].id}">
                                ${data.proprietes[i].propriete}
                            </label>
                            <div class="col-md-6">
                                <input type="checkbox" checked id="${data.proprietes[i].id}" class="checkbox_propertie" name="propriete[]" autofocus value="${data.proprietes[i].id}"/>
                            </div>
                        </div>`);
                    } else { 
                        $( ".proprietes" ).append(`
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="${data.proprietes[i].id}">
                                ${data.proprietes[i].propriete}
                            </label>
                            <div class="col-md-6">
                                <input type="checkbox" class="checkbox_propertie" name="propriete[]" autofocus id="${data.proprietes[i].id}"value="${data.proprietes[i].id}"/>
                            </div>
                        </div>`);
                    }
                }
            },error: function (data){
                $('.proprietes').empty();
            }
        });
    })
    $( "#select_category" ).change(function() {
        $("#select_category option:checked").each(function(){
            var category_id = $("#select_category option:checked").val();
            var house_id = $("#house_id").val();
            $.ajax({
                type: 'GET',
                url: site+'/json_propriete/'+house_id+'/'+category_id,
                dataType: "json",
                data: "",
                success: function(data) {
                    $('.proprietes').empty();
                var idArr = [];

                for (j in data.valArray){
                    idArr.push(data.valArray[j].propriete_id);
                }                

                for (i in data.proprietes) {
                    if (idArr.indexOf(data.proprietes[i].id) !== -1) {
                        $( ".proprietes" ).append(`
                        <div class="form-group">
                            <label class="col-md-4 control-label">
                                ${data.proprietes[i].propriete}
                            </label>
                            <div class="col-md-6">
                                <input type="checkbox" checked class="checkbox_propertie" name="propriete[]" autofocus value="${data.proprietes[i].id}"/>
                            </div>
                        </div>`);
                    } else {
       
                        $( ".proprietes" ).append(`
                        <div class="form-group">
                            <label class="col-md-4 control-label">
                                ${data.proprietes[i].propriete}
                            </label>
                            <div class="col-md-6">
                                <input type="checkbox" class="checkbox_propertie" name="propriete[]" autofocus value="${data.proprietes[i].id}"/>
                            </div>
                        </div>`);
                    }
                }
                },error: function (data){
                    $('.proprietes').empty();
                }
            });
        })  
    });
});