
$("#select_category option:checked").each(function(){
    var house_id = $("#house_id").val();
    var category_id = $("#select_category option:checked").val();
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
                
            }
            $("input[name='propriete[]']").each(function () {
                var checkboxStatus = localStorage.getItem($(this).val());
                if(checkboxStatus == "true"){
                    $(this).attr('checked', true);
                } else {
                    $(this).attr('checked',false);
                    localStorage.removeItem($(this).val());
                }
            });

            $(document).on("click", "input[name='propriete[]']", function(){
                if($(this).is(':checked')){
                    localStorage.setItem($(this).val(), 'true');
                    var status = localStorage.getItem($(this).val());
                    $(this).attr('checked', true);
                } else {
                    localStorage.removeItem($(this).val());
                    $(this).attr('checked', false);
                }
            });
            
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
                $(document).on("click", "input[name='propriete[]']", function(){
                    if($(this).is(':checked')){
                        localStorage.setItem($(this).val(), 'true');
                        var status = localStorage.getItem($(this).val());
                        console.log(status);
                        $(this).prop('checked','true');
                    } else {
                        localStorage.removeItem($(this).val());
                    }
                });
            },error: function (data){
                $('.proprietes').empty();
            }
        });
    })  
});


