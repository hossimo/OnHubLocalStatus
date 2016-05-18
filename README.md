# OnHub Local Status
This PHP web application should be installed on a PHP enabled web server on the same network segment as your OnHub LAN connection. Once installed the application will query the state of the OnHub status API and display the results in a clean material design layout.

If you would like to test the page without access to an OnHub edit the following lines in `index.php`:

```
<?php
   $serverStatusUrl = "http://192.168.86.1/api/v1/status"; //OnHub address
   // $serverStatusUrl = "status.json";                    //testing without OnHub
?>
```

#Features:
* Uses [Material Design Lite](https://getmdl.io/index.html) to format page.
* Converts uptime from `seconds` to `xx days xx hours xx minutes xx seconds`.
* Converts boolean statuses to color coded sensible values (Online, Set, Up ...).

#TODO:
* Currently dumps the whole status JSON with minimal modifications, should better display the status to user.
* Allow the local server to log any outages (LAN or WAN on the OnHUB).
* Allow the server to email or otherwise notify the user when events happen such as when the network goes down and has come back up, or when the OnHub is updating.
* Headers / Footers and things.
* Keys need display values ("updateRequired" == "Update Required")
* The Root display of "Wan" should say "WAN"

![screen shot](https://github.com/hossimo/OnHubLocalStatus/blob/master/screenshot.png)
