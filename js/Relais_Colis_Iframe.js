//Gestion du IFRAME du relais colis

function generateHtmlButton(callback) 
{
    var myButton = document.createElement("div");
    
    if (location.protocol == "https:") {
        //myButton.innerHTML = "<img src='https://service.relaiscolis.com/widgetRC/ImagesRelaisColis/rco.png'/>";
        myButton.innerHTML = "<img style=' animation-name:displaceContent;animation-duration:1.5s;animation-delay:0.5s;animation-iteration-count :2;animation-fill-mode:forwards' src='img/icon_livraison_sm.png'/>";
    } else {
        myButton.innerHTML = "<img style=' animation-name:displaceContent;animation-duration:1.5s;animation-delay:0.5s;animation-iteration-count :2;animation-fill-mode:forwards' src='img/icon_livraison_sm.png'/>";
        //myButton.innerHTML = "<img src='http://service.relaiscolis.com/widgetRC/ImagesRelaisColis/rco.png'/>";
    }



    myButton.setAttribute('style', 'cursor: pointer; min-width: 80px;background-color: #DDAF94;border-style: solid;margin-top:8px;display:flex;flex-direction:column;align-items:center;justify-content:center; ');
    myButton.addEventListener("click", function (e) {
        displayPopUpRC();
        return false;
    }, false);

    //-------- Add iframe Listner
    window.addEventListener("message", receiveMessage, false);
    function receiveMessage(event)
    {
        //console.log("Received data (iframe) - src : ", event.data);
        if((event.data).hasOwnProperty("id")  && (event.data).hasOwnProperty("name") )
        {

            $("#overlay").css({"display": "none"});
            $("#myIframe").css({"display": "none"});
            callback(event.data);
        }

        if (event.origin !== "http://relaiscolis.com:8080")
            //console.log('origine ')
            return;
    }
    $("#relais-colis-widget-container").append(myButton);
}

function createIframeMap(callback) 
{
    var iframeDiv = document.createElement("iframe");
    //iframeDiv.setAttribute('id','popupWidget');

    iframeDiv.setAttribute('style', 'border:0; position:absolute; z-index:1000; left: calc(50% - 210px); top:350px ; background-color: #FDF8F5; animation: anim 1.3s ease-in-out;');
    
    iframeDiv.setAttribute('width', '420');
    iframeDiv.setAttribute('height', '590');
    iframeDiv.setAttribute('id', 'myIframe');

    if (location.protocol == "https:") {
        iframeDiv.setAttribute('src', 'https://service.relaiscolis.com/widgetrc/');
    } else {
        iframeDiv.setAttribute('src', 'http://service.relaiscolis.com/widgetrc/');
    }

    var overlay = document.createElement("div");
    overlay.setAttribute('id', 'overlay');
    overlay.setAttribute('style', 'position: fixed; top: 0;  left: 0;  width: 100%; height: 100%;  background: #000;  opacity: 0.5; filter: alpha(opacity=50);z-index:999;');

    overlay.addEventListener("click", function () {
        $("#overlay").css({"display": "none"});
       
        $("#myIframe").css({"display": "none"});
    }, false);

    callback(overlay, iframeDiv);
}

var displayPopUpRCalready = false;

/***
 * Cette fonction permet de vérifier si une une iframe exisite déja, si oui elle l'affiche,
 * sinon elle lance la méthode de création
 */
function displayPopUpRC()
{
    if (!displayPopUpRCalready) 
    {
        createIframeMap(function (overlay, iframeDiv) {
            $("body").append(iframeDiv);
            $("body").append(overlay);
        });
        displayPopUpRCalready = true;
    } 
    else 
    {
        $("#overlay").css({"display": "block"});
        $("#myIframe").css({"display": "block"});
    }
}