        </div><!-- end .container -->
        <!-- <div style="padding-top: 15%;"> -->
            <footer class="text-center" >
                <hr>
                <small>EOVSA Database</small>
            </footer>
        <!-- </div> -->
        <!-- jQuery -->

        <link rel="stylesheet" href="../css/bootstrap-datepicker3.css"/>
        <script type="text/javascript" src="../js/bootstrap-datepicker.min.js"></script>
        <script>
            $(document).ready(function(){
                var date_input=$('input[name="date"]'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                date_input.datepicker({
                    format: 'yyyy-mm-dd',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                });
                // date_input.datepicker(
                //     'setDate', <?php if(isset($_POST["date"])) {echo "new Date(".substr($_POST["date"],6,4).",".substr((string)intval($_POST["date"])-1,0,2).",".substr($_POST["date"],3,2).")";} else {echo "new Date()";} ?>

                // );
            })
        </script>
        <!-- Bootstrap JS -->

    </body>
</html>