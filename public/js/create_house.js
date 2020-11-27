$(document).ready(function(){ 
    $("input[name='propriete[]']").each(function () {
        localStorage.setItem(this.id, $(this).prop('checked'));
    })
    $("#select_category option:checked").each(function(){
        var house_id = $("#house_id").val();
        var category_id = $("#select_category option:checked").val();
        var atLeastOneIsChecked = $('#checkArray:checkbox:checked').length > 0;
        $.ajax({
            type: 'GET',
            url: site+'/json_propriete/'+house_id+'/'+category_id,
            dataType: "json",
            data: "",
            success: function(data) {            
                for (i in data.proprietes) {
                    $( ".proprietes" ).append(`
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="${data.proprietes[i].id}">
                            ${data.proprietes[i].propriete}
                        </label>
                        <div class="col-md-6">
                            <input type="checkbox" class="checkbox_propertie" name="propriete[]" autofocus id="${data.proprietes[i].id}"value="${data.proprietes[i].id}"/>
                        </div>
                    </div>`);

                    $("input[name='propriete[]']").each(function () {
                        console.log('this', $(this));
                        console.log($(this).prop('checked', localStorage.getItem(this.id) === 'true'));
                    });      
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
                    for (i in data.proprietes) {
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
                },error: function (data){
                    $('.proprietes').empty();
                }
            });
        })  
    });
});

$(document).on("click", "input[name='propriete[]']", function(){
    $("input[name='propriete[]']").each(function () {
        localStorage.setItem(this.id, $(this).prop('checked'));
    })
});