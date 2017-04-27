<!doctype html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <title>TEST API</title>
      <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
        <form action="api.php/transaction" method="POST">
            <ul class="form-style-1">
                <li>
                    <label>Email <span class="required">*</span></label>
                    <input type="email" name="field3" class="field-long" />
                </li>
                <li>
                    <label>Amount <span class="required">*</span></label>
                    <input type="email" name="field3" class="field-long" />
                </li>
                <li>
                    <input type="button" value="Save" id="send-req"/>
                </li>
            </ul>
        </form>
        <div id="res-block"></div>
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/scripts.js"></script>
        <script>
            $(function(){
                $("#send-req").click(function(){
                    var form = $(this).parents('form');
                    sendRequest(form);
                });
            });
        </script>
        
    </body>
</html>