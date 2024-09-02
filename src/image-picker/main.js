//htmx.config.defaultSwapStyle = "outerHTML";
// Tässä esimerkki HTMX-oletusarvojen konfiguroinnista
console.log(htmx);

function showConfirmationModal(event){

    // Jos path on suggested-images, lopetetaan suoritus(ei tehdä mitään)
    if(event.detail.path === 'suggested-images.php'){
        return; // lopettaa koko funktion suorituksen
    }

    // Estetään eventin toiminta
    event.preventDefault();

    // otetaan talteen mikä on eventin action
    const action = event.detail.elt.dataset.action;
    

    // lisätään dialog/modal HTML-koodi
    const confirmationModal = `
        <dialog class="modal">
            <div id="confirmation">
                <h2>Are you sure?</h2>
                <p>Do you really want to ${action} this picture?</p>
                <div id="confirmation-actions">
                    <button id="action-no" class="button-text">No</button>
                    <button id="action-yes" class="button ${action}">Yes</button>
                </div>
            </div>    
        </dialog>
    `;

    document.body.insertAdjacentHTML('beforeend', confirmationModal);
    const dialog = document.querySelector('dialog');

    const noBtn = document.getElementById('action-no');
    noBtn.addEventListener('click', function(){
        dialog.remove();
    });

    const yesBtn = document.getElementById('action-yes');
    yesBtn.addEventListener('click', function(){
        // jatketaan requestin suoritusta
        event.detail.issueRequest();

        dialog.remove();
    });

    dialog.showModal();
}

document.addEventListener("htmx:confirm", showConfirmationModal);
