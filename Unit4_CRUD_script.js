
  
$(document).ready(function(){

        $("#add").click(function(e){
                e.preventDefault();
                dataString=checkFields();
                if(dataString!="empty"){
                        dataString = dataString+"&action=add";
                        console.log("ajax reached", dataString)
                        $.ajax({
                                type: "POST",
                                url: "Unit4_order_ajax.php",
                                data: dataString,
                                cache: false,
                                success: function (result) {
                                        document.getElementById('col1').innerHTML = result;
                                        document.getElementById('error').innerHTML = "";
                                        document.getElementById('form').reset();
                                        highlight_row();
                                        // console.log("highlight row just called");
                                }
                        });
                }
                highlight_row();
                return;
        });

        $("#update").click(function(e){
                e.preventDefault();
                dataString=checkFields();
                if(dataString!="empty"){
                        dataString = dataString+"&action=update";
                        dataString = dataString + "&id=" + $("#id").val();
                        console.log("ajax reached", dataString)
                        $.ajax({
                                type: "POST",
                                url: "Unit4_order_ajax.php",
                                data: dataString,
                                cache: false,
                                success: function (result) {
                                        document.getElementById('col1').innerHTML = result;
                                        document.getElementById('error').innerHTML = "";
                                        document.getElementById('form').reset();
                                        highlight_row();
                                        // console.log("highlight row just called");
                                }
                        });
                }
                highlight_row();
                return;
        });

        $("#delete").click(function(e){
                e.preventDefault();
                dataString=checkFields();
                if(dataString!="empty"){
                        dataString = dataString + "&id=" + $("#id").val();
                        dataString = dataString+"&action=delete_check";
                        console.log("ajax reached", dataString)
                        $.ajax({
                                type: "POST",
                                url: "Unit4_order_ajax.php",
                                data: dataString,
                                cache: false,
                                success: function (result) {
                                        // console.log(result);
                                        if (result == 1){
                                                alert('Cannot delete--there are orders for this product');
                                                document.getElementById('form').reset();
                                                document.getElementById('error').innerHTML = "";
                                        }else{
                                                if(confirm('Are you sure you want to delete this product?')){
                                                        dataString = dataString.substring(0, dataString.length - 12) + "delete";
                                                        console.log(dataString);
                                                        $.ajax({
                                                                type: "POST",
                                                                url: "Unit4_order_ajax.php",
                                                                data: dataString,
                                                                cache: false,
                                                                success: function (result) {
                                                                        document.getElementById('col1').innerHTML = result;
                                                                        document.getElementById('form').reset();
                                                                        document.getElementById('error').innerHTML = "";
                                                                        highlight_row();
                                                                        // console.log("highlight row just called");
                                                                        // alert("Product deleted")
                                                                
                                                                }
                                                        });

                                                }
                                        }
                                }
                        });
                }
        });
        
        function checkFields() {
                var name = $("#name").val();
                var image = $("#image").val();
                var quantity = $("#quantity").val();
                var price = $("#price").val();
                var inactive = document.getElementById("inactive").checked;
                if (inactive){
                        inactive = 1;
                }
                else{
                        inactive = 0;
                }
                if (name == '') {
                        document.getElementById('name').focus();
                        document.getElementById('error').innerHTML = "Must specify a product name";
                        return "empty";
                }
                if (image == '') {
                        document.getElementById('image').focus();
                        document.getElementById('error').innerHTML = "Must specify a product image";
                        return "empty";
                }
                return "name=" + name + "&image=" + image + "&quantity=" + quantity + "&price=" + price + "&inactive=" + inactive;

        }

        function highlight_row() {
                var table = document.getElementById('display-table');
                var cells = table.getElementsByTagName('td');
            
                for (var i = 0; i < cells.length; i++) {
                    // Take each cell
                    var cell = cells[i];
                    // do something on onclick event for cell
                    cell.onclick = function () {
                        //     console.log("cell clicked");
                        // Get the row id where the cell exists
                        var rowId = this.parentNode.rowIndex;
            
                        var rowsNotSelected = table.getElementsByTagName('tr');
                        for (var row = 0; row < rowsNotSelected.length; row++) {
                            rowsNotSelected[row].style.backgroundColor = "";
                            rowsNotSelected[row].classList.remove('selected');
                        }
                        var rowSelected = table.getElementsByTagName('tr')[rowId];
                        rowSelected.style.backgroundColor = "yellow";
                        rowSelected.className += " selected";
            
                        document.getElementById("name").value = rowSelected.cells[0].innerHTML;
                        document.getElementById("image").value = rowSelected.cells[1].innerHTML;
                        document.getElementById("quantity").value = rowSelected.cells[2].innerHTML;
                        document.getElementById("price").value = rowSelected.cells[3].innerHTML;
                        //console.log(rowSelected.cells[4].innerHTML.trim());
                        if (rowSelected.cells[4].innerHTML.trim() == "yes"){
                            document.getElementById("inactive").checked = true;
                        }
                        else{
                            document.getElementById("inactive").checked = false;
                        }
                        document.getElementById("id").value = rowSelected.cells[5].innerHTML;
            
                    }
                }
            
            }

            highlight_row();

        
});

        