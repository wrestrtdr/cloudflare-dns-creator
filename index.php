<?php

include "$_SERVER[DOCUMENT_ROOT]/CloudFlare/Api.php";
include "$_SERVER[DOCUMENT_ROOT]/CloudFlare/Zone/Dns.php";

$result = "";

$key = "Your Cloudflare Zone ID goes here"; 
// Above Cloudflare Zone ID, find it in Domain Overview --> Domain Summary --> Zone ID
$id = new \Cloudflare\Api("Your Cloudflare Email", "Your Cloudflare Global API Key");
// Above Cloudflare Email + Cloudflare Global API Key (https://www.cloudflare.com/a/profile) --> Global API Key
$dns = new \Cloudflare\Zone\Dns($id);

if(!empty($_POST["name"]) and !empty($_POST["value"]) and !empty($_POST["record"])) {
    $response = $dns->create($key, $_POST["record"], $_POST["name"] . ".yourdomain.name", $_POST["value"], 1);
    // Make sure to enter your domain name above (.yourdomain.name), or else the script won't work
    if ($response->success) {
        $result = '<div class="toast toast-success" style="margin: 0 auto; width:714px;text-align: center;"><b>Success!</b> Your hostname <b>' . $_POST['name'] . '.yourdomain.name</b> is now online!</div>';
    } else {
        $result = '<div class="toast toast-error" style="margin: 0 auto; width:714px;text-align: center;"><b>Sorry!</b> Your hostname <b>' . $_POST['name'] . '.yourdomain.name</b> could not be created!</div>';
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>cloudflare-dns-creator</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="https://unpkg.com/spectre.css/dist/spectre.min.css" rel="stylesheet">
  <link href="https://unpkg.com/spectre.css/dist/spectre-exp.min.css" rel="stylesheet">
  <link href="https://unpkg.com/spectre.css/dist/spectre-icons.min.css" rel="stylesheet">
  <link href="favicon.ico?" rel="shortcut icon">
  <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="outer">
    <div class="middle">
      <div>
        <?php echo $result; ?>
      </div><br>
      <div class="inner">
        <div class="card centered text-center">
          <div class="card-header">
            <div class="card-title h5">
              cloudflare-dns-creator
            </div>
            <div class="card-subtitle text-gray">
              Create your free <!-- might enter your domain name here --> domain now!
            </div>
          </div>
          <div class="card-body">
            <form action="index.php" method="post">
              <div class="input-group">
                <input class="form-input input-lg" name="name" pattern="^[a-zA-Z0-9]+$" placeholder="Hostname" required="" type="text"> <span class="input-group-addon addon-lg">.mcpe.ga</span>
              </div><br>
              <div class="input-group">
                <input class="form-input input-lg" name="value" placeholder="IPv4 Address or Domain Name" required="" type="text">
              </div><br>
              <div class="form-group">
                <label class="form-label">Please choose the type of record</label> <label class="form-radio"><input checked name="record" required="" type="radio" value="a"> <i class="form-icon"></i> IPv4 Address (A)</label> <label class="form-radio"><input name="record" required="" type="radio" value="cname"> <i class="form-icon"></i> Domain Name (CNAME)</label>
              </div>
            </form>
          </div><br>
          <div class="card-footer">
            <div class="btn-group" role="group">
              <button class="btn btn-primary" type="submit">Let's create that!</button> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>