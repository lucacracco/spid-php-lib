<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Load spid-button style and font -->
    <link rel="stylesheet"
          href="views/spid-sp-access-button/css/spid-sp-access-button.min.css"/>
    <script type="text/javascript"
            src="views/spid-sp-access-button/js/jquery.min.js"></script>
    <script type="text/javascript"
            src="views/spid-sp-access-button/js/spid-sp-access-button.min.js"></script>

    <script>
      function spid_custom_populate() {
        // TODO: use '$mapping = $sp->getIdpList();' when the method return the logo_uri.
        var idps = [
          {
            "organization_name": "SPID SAML Check",
            "entity_id": "spid-saml-check",
            "logo_uri": "views/spid-sp-access-button/img/spid-idp-spidsamlcheck.png"
          }
        ];
        var spid_elements = document.querySelectorAll('ul[data-spid-not-remote]');
        idps.sort(() => Math.random() - 0.5)
        for (var u = 0; u < spid_elements.length; u++) {
          for (var i = 0; i < idps.length; i++) {
            spid_addIdpEntry(idps[i], spid_elements[u]);
          }
        }
      }

      /**
       * Function spid_addIdpEntry make a "li" element with the ipd link and prepend this in a element.
       *
       * @param data
       *    Is an object with "organization_name", "entity_id" and "logo_uri" values.
       * @param element
       *    Is the element where is added the new "li" element.
       */
      function spid_addIdpEntry(data, element) {
        const att = document.createAttribute("data-idp");
        att.value = data['entity_id'];
        let li = document.createElement('li');
        li.className = 'spid-idp-button-link';
        li.setAttributeNode(att);
        if (element.id.indexOf('post') !== -1) {
          li.innerHTML = `<button class="idp-button-idp-logo" name="${data['organization_name']}" type="submit"><span class="spid-sr-only">${data['organization_name']}</span><img class="spid-idp-button-logo" src="${data['logo_uri']}" alt="${data['organization_name']}" /></button></li>`
        }
        if (element.id.indexOf('get') !== -1) {
          li.innerHTML = `<a href="/login/${data['entity_id']}"><span class="spid-sr-only">${data['organization_name']}</span><img src="${data['logo_uri']}" alt="${data['organization_name']}" /></a>`
        }
        element.prepend(li)
      }

      // When page is ready populate all spid buttons.
      document.onreadystatechange = function () {
        if (document.readyState == "interactive") {
          spid_custom_populate()
        }
      }
    </script>

    <title>SPID Sp Access Button</title>
</head>
<body>
<div>
    <h2>Metodo GET</h2>
    <p><b>Non ancora funzionante; da aggiornare il file `login.php`</b></p>
    <a href="#" class="italia-it-button italia-it-button-size-xl button-spid"
       spid-idp-button="#spid-idp-button-xlarge-get" aria-haspopup="true"
       aria-expanded="false">
        <span class="italia-it-button-icon"><img
                    src="views/spid-sp-access-button/img/spid-ico-circle-bb.svg"
                    onerror="this.src='img/spid-ico-circle-bb.png'; this.onerror=null;"
                    alt=""/></span>
        <span class="italia-it-button-text">Entra con SPID</span>
    </a>
    <div id="spid-idp-button-xlarge-get"
         class="spid-idp-button spid-idp-button-tip spid-idp-button-relative">
        <ul id="spid-idp-list-xlarge-root-get" class="spid-idp-button-menu"
            data-spid-not-remote aria-labelledby="spid-idp">
            <li>
                <a class="dropdown-item" href="https://www.spid.gov.it">
                    Maggiori informazioni
                </a>
            </li>
            <li>
                <a class="dropdown-item"
                   href="https://www.spid.gov.it/richiedi-spid">
                    Non hai SPID?
                </a>
            </li>
            <li>
                <a class="dropdown-item"
                   href="https://www.spid.gov.it/serve-aiuto">
                    Serve aiuto?
                </a>
            </li>
        </ul>
    </div>
</div>
<div>
    <h2>Metodo POST</h2>
    <form name="spid_idp_access" action="/login" method="post">
        <a href="#"
           class="italia-it-button italia-it-button-size-xl button-spid"
           spid-idp-button="#spid-idp-button-xlarge-post" aria-haspopup="true"
           aria-expanded="false">
            <span class="italia-it-button-icon"><img
                        src="views/spid-sp-access-button/img/spid-ico-circle-bb.svg"
                        onerror="this.src='img/spid-ico-circle-bb.png'; this.onerror=null;"
                        alt=""/></span>
            <span class="italia-it-button-text">Entra con SPID</span>
        </a>
        <div id="spid-idp-button-xlarge-post"
             class="spid-idp-button spid-idp-button-tip spid-idp-button-relative">
            <ul id="spid-idp-list-xlarge-root-post" class="spid-idp-button-menu"
                data-spid-not-remote aria-labelledby="spid-idp">
                <li>
                    <a class="dropdown-item" href="https://www.spid.gov.it">
                        Maggiori informazioni
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                       href="https://www.spid.gov.it/richiedi-spid">
                        Non hai SPID?
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                       href="https://www.spid.gov.it/serve-aiuto">
                        Serve aiuto?
                    </a>
                </li>
            </ul>
        </div>
    </form>
</div>
</body>
</html>
