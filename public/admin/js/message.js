

// Login message
let usernameRequired = 'Username is valid';
let passwordRequired = 'Password is valid';


// common
let regex = /^[a-zA-Z0-9.\-_$@*!]{6,30}$/;
let currentTime = new Date().getTime();
let nameAlerModel = "c_" + currentTime;

function showMessage(message) {
    let alertModal = $("." + nameAlerModel);
    if (alertModal.length > 0) {
        $("body").find("." + nameAlerModel).find(".alertMessage").html(message);
        $("body").find("." + nameAlerModel).modal('show');
        return;
    }

    $("body").append('<div class="modal fade ' + nameAlerModel + '" role="dialog">\n' +
        '    <div class="modal-dialog modal-sm">\n' +
        '      <div class="modal-content">\n' +
        '        <div class="modal-header">\n' +
        '          <button type="button" class="close" data-dismiss="modal">&times;</button>\n' +
        '          <h4 class="modal-title">Message</h4>\n' +
        '        </div>\n' +
        '        <div class="modal-body">\n' +
        '          <p class="alertMessage">Message</p>\n' +
        '        </div>\n' +
        '        <div class="modal-footer">\n' +
        '          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>\n' +
        '        </div>\n' +
        '      </div>\n' +
        '    </div>\n' +
        '  </div>');
    showMessage(message);
}