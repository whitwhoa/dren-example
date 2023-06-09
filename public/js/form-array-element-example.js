function generateKeyValuePairFormElement()
{
    let existingCount = $('#keyValuePairForm .keyValueFormElement').length;
    let mu = '';
    mu += '<div class="keyValueFormElement mb-1 mt-4">';
        mu += '<div class="row">';
            mu += '<div class="col-md-4">';
                mu += '<input class="form-control" name="keyValPair[' + existingCount + '][key]" placeholder="Key">';
            mu+= '</div>';
            mu += '<div class="col-md-4">';
                mu += '<input class="form-control" name="keyValPair[' + existingCount + '][value]" placeholder="Value">';
            mu+= '</div>';
            mu += '<div class="col-md-4 text-right">';
                mu += '<button type="button" class="btn btn-success addKeyValueNoteButton" data-key-value-row-id="' + existingCount + '">+ Note</button>';
            mu+= '</div>';
        mu+= '</div>';
        mu += '<div id="keyValueNotesElement_' + existingCount +'" class="d-none">';

        mu += '</div>';
    mu += '</div>';

    $('#keyValuePairForm').append(mu);
    $('#keyValuePairFormSubmitButton').removeClass('d-none');
}

function generateKeyValuePairNoteFormElement(keyValueRowId)
{
    let notesCount = $('#keyValueNotesElement_' + keyValueRowId + ' .noteInput').length;

    let mu = '';
    mu += '<div class="row mt-1">';
        mu += '<div class="col">';
            mu += '<input class="form-control noteInput" name="keyValPair[' + keyValueRowId + '][notes][' + notesCount + ']" placeholder="Note">';
        mu += '</div>';
    mu += '</div>';

    $('#keyValueNotesElement_' + keyValueRowId).append(mu);
    $('#keyValueNotesElement_' + keyValueRowId).removeClass('d-none');
}

$(document).ready(function(){

    $('#addKeyValButton').click(function(){

        generateKeyValuePairFormElement();

    });

    $('#keyValuePairForm').on('click', '.addKeyValueNoteButton', function(){

        generateKeyValuePairNoteFormElement($(this).data('key-value-row-id'));

    });

});