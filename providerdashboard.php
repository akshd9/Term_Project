<?php
require_once 'session.php';
require_once 'DB.php';

if (!isset($_SESSION['provider_id'])) {
    header('Location: providerlogin.php');
    exit();
}

$provider_id = $_SESSION['provider_id'];
$provider = DB::query("SELECT * FROM providers WHERE id = ?", [$provider_id])->fetch();

include_once "./include/providerheader.php";
?>

<div class="container" style="margin-top: 30px;">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Welcome, <?= htmlspecialchars($provider['name']); ?></h3>
            <hr>
            <div class="row">
                <div class="col-md-4 text-center">
                    <img style="height: 150px;" src="storage/<?= htmlspecialchars($provider['photo']); ?>" alt="Provider Photo" class="img-thumbnail">
                    <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                </div>
                <div class="col-md-8">
                    <p><strong>Contact:</strong> <?= htmlspecialchars($provider['contact']); ?></p>
                    <p><strong>Address:</strong> <?= htmlspecialchars($provider['adder1'] . ", " . $provider['adder2'] . ", " . $provider['city']); ?></p>
                    <p><strong>Profession:</strong> <?= htmlspecialchars($provider['profession']); ?></p>
                    <p><strong>Description:</strong> <?= htmlspecialchars($provider['descr']); ?></p>
                    <p><strong>Wallet Balance:</strong> Kshs<span id="wallet-balance"><?= number_format($provider['wallet_balance'], 2); ?></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="scripts/update_profile.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="<?= htmlspecialchars($provider['name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact No.</label>
                        <input id="contact" name="contact" type="text" class="form-control" value="<?= htmlspecialchars($provider['contact']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="adder1">Town</label>
                        <input id="adder1" name="adder1" type="text" class="form-control" value="<?= htmlspecialchars($provider['adder1']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="adder2">Street/Road</label>
                        <input id="adder2" name="adder2" type="text" class="form-control" value="<?= htmlspecialchars($provider['adder2']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input id="city" name="city" type="text" class="form-control" value="<?= htmlspecialchars($provider['city']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input id="photo" name="photo" type="file" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label for="descr">Description</label>
                        <textarea id="descr" name="descr" class="form-control" rows="3" required><?= htmlspecialchars($provider['descr']); ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function fetchWalletBalance() {
        fetch('api/providerfetch_wallet.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('wallet-balance').innerText = data.wallet_balance.toFixed(2);
            })
            .catch(error => console.error('Error fetching wallet balance:', error));
    }

    // Fetch wallet balance every 30 seconds
    setInterval(fetchWalletBalance, 30000);
</script>

<?php
include_once "./include/footer.php";
?>
