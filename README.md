![prestashop shopping cart hosted on plesk onyx nginx](img/prestashop-logo.png?raw=true "PrestaShop Shopping Cart Hosted on Plesk Onyx NGINX")
# Secure Plesk Onyx With Custom Templates
This guide hopes to secure your thirty bees shopping cart using [*Plesk Onyx*](https://plesk.com "Plesk Hosting Control Panel") vps or dedicated server. And, ensure that [**PrestaShop shopping cart**](https://prestashop.com "PrestaShop Shopping Cart") will run with NGINX as its proxy server using fastCGI Proxy.

## This repository is still beta
You should not use our tag releases until we reach 1.0 Feel free to fork and contribute, though.

## What Does Work
The SSL Security seems to be stable. OSCP Stapling, Forward Secrecy, SSL Session Cache, HSTS. When you install an SSL certificate, in the Certificate Authority Box, you must paste both the intermediate and the root certs for this to work. And, make it the cert that is used to encrypt your vps/dedicated as well as default and used for webmail.

### PCI Compliance
Run this command from your bash shell: `plesk sbin pci_compliance_resolver --enable`. It should create dhparams and change the cipher suite. Not good enough, though. Edit `/etc/nginx/conf.d/ssl.conf`. Change to:

```
ssl_ciphers ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-CHACHA20-POLY1305:ECDHE-RSA-CHACHA20-POLY1305:ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-SHA384:ECDHE-RSA-AES256-SHA384:ECDHE-ECDSA-AES128-SHA256:ECDHE-RSA-AES128-SHA256;
```
#### SSL Protocols
Change your **ssl_protocols** to

```
ssl_protocols TLSv1.1 TLSv1.2;
```

**NOTE**: Email to older email software will not work once you disable TLSv1.0

And, that's all you need to edit in `/etc/nginx/conf.d/ssl.conf`.

## Installing Custom Plesk Admin Templates
Copy the `/opt/psa/admin/conf/templates/custom/` and all its files and folders to the same location. In most FTP software, just drag the **custom** folder icon over to `/opt/psa/admin/conf/templates/`. Then, run the command:
```
/opt/psa/admin/bin/httpdmng --reconfigure-all
```
**COPY** & **PASTE** the contents of `domain.tld.conf` to domains => [YOUR DOMAIN] => Apache & NGINX Settings => **NGINX Parameters**.
A developer will need to edit this if your static link rewrites are not in English. An example would be:
```
rewrite ^/supplier(.*)$ /supplier.php$1 last;
```
Where *supplier* is the word you need translated to your language. Click **OK** to apply the custom **NGINX** parameters.
## Contributors List
[Contributors](CONTRIBUTORS.md)
