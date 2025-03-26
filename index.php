<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool4cars</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Client Selection -->
    <select id="changeClient">
        <option value="clienta">Client A</option>
        <option value="clientb">Client B</option>
        <option value="clientc">Client C</option>
    </select>

    <!-- Module Selection (Only for Client B) -->
    <select id="changeModule" style="display: none;">
        <option value="cars">Cars</option>
        <option value="garages" id="garageOption">Garages</option>
    </select>

    <div class="dynamic-div" data-module="cars" data-script="ajax"></div>

    <script>
        // Get cookie
        function getCookie(name) {
            let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
            return match ? match[2] : null;
        }

        // set Cookie
        function setCookie(name, value, days) {
            let expires = new Date();
            expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
            document.cookie = name + "=" + value + ";expires=" + expires.toUTCString() + ";path=/";
        }

        function loadContent() {
            let client = getCookie('client_id') || 'clienta';  // Default view to clienta
            let module = $(".dynamic-div").data("module");

            console.log("Client selected:", client);
            console.log("Module selected:", module);

            let script = (module === 'garages') ? 'garagesList' : 'carsList';

            $(".dynamic-div").load(`customs/${client}/modules/${module}/${script}.php?client=${client}`);
        }

        $(document).ready(function() {
            let client = getCookie('client_id') || 'clienta';
            $("#changeClient").val(client);
            loadContent();

            // Show or hide the Garage option and module select based on the selected client
            if (client === 'clientb') {
                $('#garageOption').show();
                $('#changeModule').show();
            } else {
                $('#garageOption').hide();
                $('#changeModule').hide();
            }

            // Client selection change
            $("#changeClient").on("change", function() {
                let selectedClient = $(this).val();
                setCookie('client_id', selectedClient, 7);
                loadContent();

                if (selectedClient === 'clientb') {
                    $('#garageOption').show();
                    $('#changeModule').show();
                } else {
                    $('#garageOption').hide();
                    $('#changeModule').hide();
                }

                $("#changeModule").val("cars");
            });

            // Module change
            $("#changeModule").on("change", function() {
                let selectedModule = $(this).val();
                $(".dynamic-div").data("module", selectedModule);
                loadContent();
            });

            $(document).on("click", ".garage-item", function() {
                let garageId = $(this).data("id");
                let client = getCookie('client_id') || 'clienta';

                $(".dynamic-div").load(`customs/${client}/modules/garages/garageDetails.php?client=${client}&garage_id=${garageId}`);
            });

            $(document).on("click", ".car-item", function() {
                let carId = $(this).data("id");
                let client = getCookie('client_id') || 'clienta';

                $(".dynamic-div").load(`customs/edit.php?client=${client}&car_id=${carId}`);
            });
        });
    </script>

</body>
</html>
