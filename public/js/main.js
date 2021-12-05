var pendingFormConfirmation;

function confirmDeleteModal(button){
    var confModal = new bootstrap.Modal(document.getElementById('confirm_modal'))
    confModal.show('fast');
    console.log(button);
    console.log(button.parentElement);
    pendingFormConfirmation = button.parentElement;
}

function confirmButton(){
    pendingFormConfirmation.submit();
}