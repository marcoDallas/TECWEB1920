<?php
require_once 'backend/print_content.php';
echo(Print_content::top('xhtml+aria'));
echo(Print_content::openHTML());
echo(Print_content::head('Contatti'));
echo(Print_content::openBody());
echo(Print_content::header('Come e quando puoi contattarci','contatti.php')."\r");
echo(Print_content::breadcrumb('<strong>Contatti</strong>')."\r");
echo(Print_content::openGeneralContainer());
echo(Print_content::menu("contatti.php"));
echo(Print_content::openLoginNewsContainer());
echo(Print_content::login_form());
echo(Print_content::news("contatti.php"));
echo(Print_content::closeDiv());
?>
    <div id="content" class="large_column" role="article">
            <div id="contentContatti">
                <h2>Contatti</h2>
                <p>
                    Sempre al servizio del cliente, reperibilità garantita. Se vuoi avere maggiori informazioni sui prodotti che
                    offriamo al pubblico o per qualsiasi altra evenienza, puoi contattarci via mail o con uno squillo di telefono.
                </p>
                <dl>
                    <dt>Telefono: 049 000000</dt>
                    <dt>Mail: marco.dalla.libera.2@studenti.unipd.it</dt>
                </dl>
                <h2>Orari</h2>
                <p>
                    Sia nei giorni feriali che in quelli festivi, la nostra pasticceria è aperta. Ecco i nostri orari:
                </p>
                <dl>
                    <dt><strong>Dal lunedì al venerdì</strong></dt>
                    <dt>Mattina: 7:00 - 12:30</dt>
                    <dt>Pomeriggio: 14:30 - 18:00</dt>
                </dl>
                <dl>
                    <dt><strong>Sabato e domenica</strong></dt>
                    <dt>Mattina: 7:00 - 12:30</dt>
                </dl>
                <h2>Dove ci puoi trovare?</h2>
                <p>
                    Indirizzo: Via Trieste, 63 - 35121 Padova (Italia)
                </p>
                <object tabindex="-1" title="Posizione della pasticceria sulla mappa" data="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2800.8988785932547!2d11.885283915057387!3d45.41137867910036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x477eda58b44676df%3A0xfacae5884fca17f5!2sTorre+Archimede%2C+Via+Trieste%2C+63%2C+35121+Padova+PD!5e0!3m2!1sit!2sit!4v1546637087232" id="maps"></object>
            </div>
        </div>
    </div>
<?php
echo(Print_content::closeDiv());
echo(Print_content::footer());
echo(Print_content::closeBody());
echo(Print_content::closeHTML());
?>