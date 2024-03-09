<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Example Docker-based demo application</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-italia/dist/js/bootstrap-italia.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-italia/dist/css/bootstrap-italia.min.css">

    <!-- Load spid-button style and font -->
    <link rel="stylesheet" href="views/spid-sp-access-button/css/spid-sp-access-button.min.css"/>
    <script type="text/javascript" src="views/spid-sp-access-button/js/jquery.min.js"></script>
    <script type="text/javascript" src="views/spid-sp-access-button/js/spid-sp-access-button.min.js"></script>
    <script>
        function spid_custom_populate() {
            // TODO: use '$mapping = $sp->getIdpList();' when the method return the logo_uri.
            var idps = [
                {
                    "organization_name": "SPID Demo",
                    "entity_id": "spid-demo",
                    "logo_uri": "views/spid-sp-access-button/img/spid-idp-demo.svg"
                },
                {
                    "organization_name": "SPID SAML Check",
                    "entity_id": "spid-saml-check",
                    "logo_uri": "views/spid-sp-access-button/img/spid-idp-saml-check.svg"
                }
            ];
            var spid_elements = document.querySelectorAll('ul[data-spid-not-remote]');
            idps.sort(() => Math.random() - 0.5);
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
                li.innerHTML = `<button class="idp-button-idp-logo" name="selected_idp" value="${data['entity_id']}" type="submit"><span class="spid-sr-only">${data['organization_name']}</span><img class="spid-idp-button-logo" src="${data['logo_uri']}" alt="${data['organization_name']}" /></button></li>`
            }
            if (element.id.indexOf('get') !== -1) {
                li.innerHTML = `<a href="/login?selected_idp=${data['entity_id']}"><span class="spid-sr-only">${data['organization_name']}</span><img src="${data['logo_uri']}" alt="${data['organization_name']}" /></a>`
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
</head>
<body>
<div class="col-lg-8 mx-auto p-4 py-md-5">
    <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
        <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
            <span class="fs-4">Example Docker-based demo application</span>
        </a>
    </header>

    <main>
        <h1 class="text-body-emphasis">Get started with test</h1>
        <p>Will be use <a href="https://github.com/italia/spid-saml-check" target="_blank">SPID SAML Check</a>.</p>
        <p>
            SPID SAML Check is an application suite that provides some tools for
            Service Providers, useful for inspecting requests shipped to an
            Identity Provider, checking metadata compliance and sending custom
            responses back to Service Provider. It includes:
        </p>
        <ul>
            <li>spid-sp-test to check the SPID specifications compliance</li>
            <li>a web application (spid-validator) that provides an easy to use interface</li>
            <li>a web application (spid-demo) that acts as a test IdP for demo purpose</li>
        </ul>

        <div class="row g-5 py-5">
            <div class="col-md-6">
                <h2 class="text-body-emphasis">Requirements</h2>
                <p>Metadata configuration between Service Provider and Identity Provider.</p>
                <ul>
                    <li>
                        Get the <a href="http://sp.docker.localhost/metadata" target="_blank">SP metadata</a>, then copy
                        these over to the IdP and register the SP with the <a href="http://idp.docker.localhost"
                                                                              target="_blank">IDP</a> (<code>validator/validator</code>)
                    </li>
                    <li>
                        Get the <a href="http://idp.docker.localhost" target="_blank">IDP Metadata</a>, then save it as
                        <code>"example/idp_metadata/spid-demo.xml"</code> to register the IDP with the SP
                    </li>
                </ul>
                <h3>Others</h3>
                <ul>
                    <li><a href="/acs" target="_blank">Acs</a></li>
                    <li><a href="/metadata" target="_blank">Metadata</a></li>
                    <li><a href="http://idp.docker.localhost/demo/users" target="_blank">Users available</a></li>
                </ul>
            </div>

            <div class="col-md-6">
                <h2 class="text-body-emphasis">SPID Sp Access Button</h2>
                <p>
                    See repository <a href="https://github.com/italia/spid-sp-access-button" target="_blank">italia/spid-sp-access-button</a>.
                </p>
                <div style="position:relative">
                    <h3>Metodo GET</h3>
                    <a href="#" class="italia-it-button italia-it-button-size-m button-spid"
                       spid-idp-button="#spid-idp-button-medium-get" aria-haspopup="true" aria-expanded="false">
                            <span class="italia-it-button-icon">
                                <img src="views/spid-sp-access-button/img/spid-ico-circle-bb.svg"
                                     onerror="this.src='img/spid-ico-circle-bb.png'; this.onerror=null;"
                                     alt=""/></span>
                        <span class="italia-it-button-text">Entra con SPID</span>
                    </a>
                    <div id="spid-idp-button-medium-get"
                         class="spid-idp-button spid-idp-button-tip spid-idp-button-relative">
                        <ul id="spid-idp-list-large-root-get" class="spid-idp-button-menu" data-spid-not-remote
                            aria-labelledby="spid-idp">
                            <li>
                                <a class="dropdown-item" href="https://www.spid.gov.it">
                                    Maggiori informazioni
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="https://www.spid.gov.it/richiedi-spid">
                                    Non hai SPID?
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="https://www.spid.gov.it/serve-aiuto">
                                    Serve aiuto?
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div style="position:relative">
                    <h3>Metodo POST</h3>
                    <form name="spid_idp_access" action="/login" method="post">
                        <a href="#" class="italia-it-button italia-it-button-size-m button-spid"
                           spid-idp-button="#spid-idp-button-medium-post" aria-haspopup="true"
                           aria-expanded="false">
                            <span class="italia-it-button-icon">
                                    <img src="views/spid-sp-access-button/img/spid-ico-circle-bb.svg"
                                         onerror="this.src='img/spid-ico-circle-bb.png'; this.onerror=null;"
                                         alt=""/></span>
                            <span class="italia-it-button-text">Entra con SPID</span>
                        </a>
                        <div id="spid-idp-button-medium-post"
                             class="spid-idp-button spid-idp-button-tip spid-idp-button-relative">
                            <ul id="spid-idp-list-large-root-post" class="spid-idp-button-menu" data-spid-not-remote
                                aria-labelledby="spid-idp">
                                <li>
                                    <a class="dropdown-item" href="https://www.spid.gov.it"> Maggiori informazioni </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="https://www.spid.gov.it/richiedi-spid">
                                        Non hai SPID?
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="https://www.spid.gov.it/serve-aiuto">
                                        Serve aiuto?
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <h2 class="text-body-emphasis">Direct POST</h2>
                <p>Use SPID Demo.<br> Read more detailed instructions and documentation.</p>
                <form name="direct_post" action="/login" method="post" class="d-inline">
                    <button class="btn btn-success"> Login</button>
                </form>
                <form name="direct_post" action="/logout" method="post" class="d-inline">
                    <button class="btn btn-danger"> Logout</button>
                </form>
            </div>

            <div class="col-md-6">
                <h2 class="text-body-emphasis">Direct GET</h2>
                <p>Use SPID Demo.<br> Read more detailed instructions and documentation.</p>
                <a class="btn btn-success" role="button" href="/login"> Login </a>
                <a class="btn btn-danger" role="button" href="/logout"> Logout </a>
            </div>

        </div>
    </main>
    <footer class="pt-5 my-5 text-body-secondary border-top">
        Created for tests.
    </footer>
</div>
</body>
</html>
