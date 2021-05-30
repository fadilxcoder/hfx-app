# HFX App Dev

---

## Notes

- Use **virtual host**
- Templating engine `league/plates`
- - Include file by `$this->insert('modals/logout.html')`
- - Added function extension in `ViewManager.php`
- - Call in `base.layout.php` by `echo $this->e($this->session('name_user'))` - (Cannot return objects)
- Added dependency injection 
- - Container in templates in `View.php`
- - Call in `dashboard.html.php` by `dump($this->data['container']['DI_sessions'])`
- Elasticsearch
- Algolia
- - https://curl.haxx.se/ca/cacert.pem
- - `curl.cainfo="C:\wamp64\www\hfx-app\cacert.pem"` in php.ini
- Custom made command in `composer.json`

