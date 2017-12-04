# cloudflare-dns-creator

A simple PHP script to create DNS records using the Cloudflare PHP API.

# Installation

You will need:
* Cloudflare
* Web server (PHP)
* Domain name

```
git clone https://github.com/caspermcpe/cloudflare-dns-creator.git
```

Alternatively, download as [a ZIP-archive](https://github.com/caspermcpe/cloudflare-dns-creator/archive/master.zip) and extract the files to your web server.
When everything is on place, running a correctly configured web server, you can begin with modifying the files.

**OPTIONAL: Rename the file "htaccess.txt" to ".htaccess" to get the recommended settings for an Apache HTTP server.**

```php
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
```
In the "index.php" file (code snippet above), make sure to edit the the `$key = "Your Cloudflare Zone ID goes here";` and `$id = new \Cloudflare\Api("Your Cloudflare Email", "Your Cloudflare Global API Key")`.
There are comments below each one of these lines, if you need help with finding your Cloudflare keys.
**Also make sure to replace all entries of `yourdomain.name` with your actual domain name.**

# Made using …

* [Spectre CSS Framework](https://github.com/picturepan2/spectre)
* [Cloudflare PHP API](https://github.com/jamesryanbell/cloudflare)

# License
MIT License — see the [LICENSE.md](https://github.com/caspermcpe/cloudflare-dns-creator/blob/master/LICENSE.md) for more details.
