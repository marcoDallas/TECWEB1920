# TECWEB1920
Progetto Tecnologie WEB 2019/2020

![Image of Yaktocat](website/www/images/logo.png)

## Regole di buona condotta

### Generali

Prima di fare qualsiasi modifica al codice coordinarsi con il resto del gruppo e creare e/o assegnarsi una Issue, al fine di limitare al minimo il lavoro in doppio. 

Se vi vengono in mente più modifiche da fare scrivete pure più Issue ed incaricatevi solo quelle che riuscite a gestire in breve tempo, lasciando le altre al resto del gruppo così da lavorare in parallelo.

### Scrittura del codice
**CODIFICA:** impostare l'IDE o l'editor che utilizzate con la codifica `Unicode (UTF-8 without signature) - Codepage 65001` al fine di evitare i warning di validazione segnalati nella issue #18 .

E' buona norma seguire le indicazioni delle prime lezioni di TOS: a nostra scelta se adottare gitflow o feature-flow come workflow di lavoro. Gitflow è un tantino più "costruito" però sarebbe ottimo, in ogni caso per questo progetto dovrebbbe bastare anche il feature-flow.

### Branch e Merge
Idealmente ogni Issue va sviluppata su un suo branch dedicato. Ogni branch può avere (e normalmente ha) più commit al suo interno. Effettuare il merge del branch sul ramo principale solo dopo aver controllato di non aver introdotto bug che possano minare il lavoro degli altri.

Una volta effettuato il merge del branch sul trunk principale eliminare il branch temporaneo su cui si era lavorato.

**NOTA BENE:** ogni volta che si vuole fare un merge, bisogna accertarsi che il codice sia valido XHTML. Per validare il codice: https://validator.w3.org/.

### Commit
Cercare di tenerli il più possibile "atomici" e collegarli sempre al codice della Issue. Atomici significa che ogni commit dovrebbe registrare solo un tipo di modifica, non una lista. Ag ogni Issue possono corrispondere più commit e viceversa.

[Questa](https://chris.beams.io/posts/git-commit/) è secondo me una buona linea guida su come scrivere messaggi di commit efficaci.

### Morale
Coordinarci dovrebbe rendere il lavoro più semplice e veloce per tutti, aiutando anche a dividere in modo equo il carico di lavoro.
Implementare le linee guida alla lettera sarà complicato però provarci dovrebbe aiutare sia in TOS che SWE.
In caso di casini si può comunque sistemare il codice visto che è versionato e decentralizzato.
Aggiungere in questo file ogni altra indicazione che può essere utile come regola di gruppo.

## Regole per il Progetto di Tecnologie Web

•	Il progetto deve essere realizzato da gruppi di 4 persone.
•	La consegna del progetto nella sessione di Febbraio (e solo per quella di Febbraio) prevede due punti bonus,da sommare al voto conseguito nel progetto SOLO se il progetto è     valutato nel complesso in maniera sufficiente (>= 18).
•	Il voto conseguito con la consegna del progetto resta valido per l’intero anno accademico, ovvero fino al 30 settembre 2020. Lo scritto deve essere superato entro la stessa     data.
•	Nel caso in cui il progetto sia valutato insufficiente o se il voto conseguito non risulti essere soddisfacente, è necessario rifare per intero il progetto, ripartendo da       zero e senza il riutilizzo di codice utilizzato nel progetto già consegnato.
•	In caso di sospetta copiatura, i docenti convocheranno gli studenti del/dei gruppo/i per un esame orale. In caso di diniego il progetto viene automaticamente valutato           insufficiente.
•	I docenti si riservano la possibilità di richiedere, a propria discrezione, orali integrativi ai gruppi.

### Specifiche tecniche
•	Il sito web deve essere realizzato con lo standard XHTML Strict, eventuali pagine in HTML5 sono permesse, ma queste devono essere giustificate e degradare in modo elegante (devono rispettare le regole XHTML):
•	il layout deve essere realizzato con CSS puri (CSS2 o CSS3);
•	il sito web deve rispettare la completa separazione tra contenuto, presentazione e comportamento;
•	il sito web deve essere accessibile a tutte le categorie di utenti;
•	il sito web deve organizzare i propri contenuti in modo da poter essere facilmente reperiti da qualsiasi utente;
•	il sito web deve contenere pagine che utilizzino script PHP per collezionare e pubblicare dati inseriti dagli utenti (deve essere sviluppata anche la possibilità di modifica e cancellazione dei dati stessi);
•	deve essere presente una forma di controllo dell’input inserito dall’utente, sia lato client che lato server
•	i dati inseriti dagli utenti devono essere salvati in un database;
•	è preferibile che il database sia in forma normale.
Il progetto `deve essere accompagnato da una relazione` che ne illustri le fasi di progettazione, realizzazione e test ed evidenzi il ruolo svolto dai singoli componenti del gruppo.
Viene richiesta un'analisi iniziale delle caratteristiche degli utenti che il sito si propone di raggiungere. Le pagine web devono essere accessibili indipendentemente dal browser e dalle dimensioni dello schermo del dispositivo degli utenti. Considerazioni riguardanti diversi dispositivi (laddove possibile) verranno valutate positivamente.
Il non rispetto di anche una sola di queste specifiche comporta la `non sufficienza` del progetto.

## Regole per la consegna del progetto

Il non rispetto di anche una sola di queste regole può comportare `l'esclusione dalla consegna o una penalizzazione nella valutazione`:
1.	la relazione deve contenere `in prima pagina`:
    - indirizzo web del sito;
    - eventuali password degli utenti da utilizzare in fase di correzione (una coppia login-passwd per ogni classe di utenza), in particolare:
    - l’utente amministratore, se presente, deve avere login e password uguali ad admin;
    - l’utente semplice, se presente, deve avere login e password uguali ad user;
    - indirizzo email del referente del gruppo per eventuali comunicazioni.
2.	i file PHP devono avere i permessi corretti;
3.	il sito deve utilizzare link relativi in modo da poter essere facilmente installato anche su server o cartelle diverse. Se l’installazione necessita di operazioni               particolari queste devono essere indicate in relazione;
4.	il progetto deve essere consegnato in due modi:
    -il progetto deve essere installato sulla macchina `tecweb.studenti.math.unipd.it`, sulla home page di uno dei componenti del gruppo (questa login verrà bloccata per il tempo necessario alla correzione, in genere una settimana).
    -Tramite un form di consegna che verrà attivato ad ogni sessione d’esame all’interno della piattaforma moodle alla pagina del corso
Le istruzioni per l'accesso alla macchina tecweb.studenti.math.unipd.it si trovano su questa [pagina](http://www.studenti.math.unipd.it/tecweb/), gestita dal servizio di calcolo.

### Istruzioni per l'utilizzo del form di consegna
Oltre alla consegna del progetto sull’account designato nel server tecweb, è necessario consegnare una copia del progetto attraverso la pagina del corso presente sul moodle. Ad ogni sessione di consegna, verrà attivata una form tramite la quale il responsabile del gruppo deve caricare un file zip contenente tutto il codice sorgente del progetto (ovvero, i file presenti sull’account del server tecweb) e la relazione.
Il file deve essere caricato entro la scadenza fissata per la consegna del progetto, pena l’esclusione dalla correzione (il progetto dovrà quindi essere riconsegnato la sessione successiva).

### Date di consegna
1. Sessione Invernale: 28 gennaio 2020 pre 13
2. Sessione Estiva: 26 giugno 2020
3. Sessione Autunnale: 2 settembre 2020


## Membri del gruppo:

* Alberto Gobbo
* Marco Dalla Libera
* Riccardo Cestaro
* Stefano Lazzaroni
