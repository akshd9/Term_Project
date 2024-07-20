<?php
include_once "./include/header.php";

$cities = ["Nairobi", "Mombasa", "Kisumu", "Nakuru", "Eldoret", "Thika", "Malindi", "Kitale", "Garissa", "Kakamega", "Kisii", "Machakos", "Meru", "Nyeri", "Naivasha", "Kericho", "Embu", "Nanyuki", "Narok", "Bungoma", "Voi", "Lodwar", "Mumias", "Busia", "Homa Bay", "Kitui", "Siaya", "Kapenguria", "Bomet", "Isiolo", "Nyahururu", "Migori", "Chuka", "Marsabit", "Maralal", "Wajir", "Mandera", "Lamu", "Taveta", "Iten", "Bondo", "Moyale", "Kwale"];
?>

<h2 class="text-center" style="margin-top: 20px">Home Services</h2>
<hr>
<div class="container" style="margin-top:20px; margin-bottom: 60px;">
    <div class="row">
        <div class="form-group col-5">
            <label for="city">City</label>
            <select class="form-control" name="city" id="city">
                <option value="none">-- Select City --</option>
                <?php foreach ($cities as $city) : ?>
                    <option value="<?= htmlspecialchars($city) ?>"><?= htmlspecialchars($city) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-5">
            <label for="profession">Who's Required</label>
            <select class="form-control" name="profession" id="profession">
                <option value="none">Select Profession</option>
                <?php
                $professions = [
                    "accountant", "actor", "actuary", "acupuncturist", "advertising_consultant",
                    "aerospace_engineer", "agricultural_engineer", "air_traffic_controller",
                    "aircraft_mechanic", "architect", "artist", "assembler", "astronomer",
                    "athlete", "attorney", "auctioneer", "audiologist", "baker", "banker", "barber",
                    "bartender", "biochemist", "biologist", "blacksmith", "boilermaker", "bookkeeper",
                    "bricklayer", "broker", "builder", "bus_driver", "butcher", "cabinetmaker", "carpenter",
                    "cashier", "chef", "chemist", "civil_engineer", "clerk", "coach", "computer_programmer",
                    "conductor", "construction_worker", "consultant", "cook", "copywriter", "counselor",
                    "dancer", "data_analyst", "data_scientist", "dentist", "designer", "dietitian",
                    "doctor", "economist", "editor", "electrician", "engineer", "entrepreneur",
                    "environmental_scientist", "event_planner", "farmer", "fashion_designer",
                    "film_director", "financial_advisor", "firefighter", "fisherman", "florist",
                    "graphic_designer", "hairdresser", "historian", "hotel_manager",
                    "human_resources_manager", "illustrator", "industrial_designer", "insurance_agent",
                    "interior_designer", "interpreter", "it_support_specialist", "journalist", "judge",
                    "landscape_architect", "librarian", "locksmith", "machine_operator", "magician",
                    "makeup_artist", "manager", "marketing_specialist", "masseur", "mechanic",
                    "medical_assistant", "microbiologist", "mobile_repairer", "model", "musician",
                    "nurse", "nutritionist", "occupational_therapist", "optician", "painter",
                    "paramedic", "paralegal", "pharmacist", "photographer", "physician", "physicist",
                    "pilot", "plumber", "police_officer", "politician", "postal_worker", "professor",
                    "programmer", "psychologist", "realtor", "receptionist", "recruiter", "researcher",
                    "sales_manager", "salesperson", "scientist", "security_guard", "social_worker",
                    "software_developer", "software_engineer", "statistician", "surgeon", "teacher",
                    "technician", "therapist", "translator", "truck_driver", "tutor", "veterinarian",
                    "video_editor", "waiter", "web_developer", "welder", "writer"
                ];
                foreach ($professions as $profession) {
                    echo "<option value=\"$profession\">$profession</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group col-2">
            <label for="search">Action</label>
            <button id="search" class="form-control btn btn-success" type="button">Search</button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="providers" class="table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Profession</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan='5'>Select city and profession..</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="js/jquery.js"></script>
<script>
   $(function() {
    $("#search").click(function() {
        var city = $("#city").val();
        var profession = $("#profession").val();

        if (city == "none" || profession == "none") {
            alert("Don't leave fields empty!");
            $("#providers tbody").html("<tr><td colspan='5'>Please fill in all fields.</td></tr>");
        } else {
            $.post('scripts/searchproviders.php', {
                city: city,
                profession: profession
            }, function(res) {
                var providers = JSON.parse(res);
                var tbody = "";

                if (providers.failed) {
                    tbody = "<tr><td colspan='5'>No Service Providers found...</td></tr>";
                } else {
                    providers.forEach(function(provider) {
                        console.log('Photo path: storage/' + provider.photo); // Debugging line
                        tbody += "<tr>" +
                            "<td><img style='height:100px' src='storage/" + provider.photo + "' onerror=\"this.onerror=null;this.src='img/image.jpg';\"/></td>" +
                            "<td>" + provider.name + "</td>" +
                            "<td>" + provider.adder1 + ",<br>" + provider.adder2 + ",<br>" + provider.city + "</td>" +
                            "<td>" + provider.profession + "</td>" +
                            "<td><a href='booking.php?provider=" + provider.id + "' class='btn btn-primary btn-block'>Book</a></td>" +
                            "</tr>";
                    });
                }
                $("#providers tbody").html(tbody);
            });
        }
    });
});

</script>

<?php include_once "./include/footer.php"; ?>
