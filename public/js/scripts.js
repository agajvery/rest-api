function sendRequest(form) {
    if (form.length > 0) {
        var strParams = '';
        var formParams = form.serializeArray();
        for (var index in formParams) {
            strParams = strParams + '/' + formParams[index].value;
        }

        $.ajax({
            url: form.attr('action') + strParams,
            method: form.attr('method'),
            success: successResponse,
            error: errorResponse
        });
    }
}

function successResponse(response) {
    var data = parseJson(response);

    if (data.error_message !== undefined) {
        showError("ERROR: " + data.error_message);
    } else {
        showResult("Status: " + data.status + " Transaction ID: " + data.transaction_id);
    }
}

function errorResponse(jqXHR, textStatus, errorThrown) {
//    var data = parseJson(response);
    showError('Opps!! ' + textStatus + " - " + errorThrown);
}

function showError(errors)
{
    $("#res-block").attr("class", "error").text(errors);
}

function showResult(result)
{
    $("#res-block").attr("class", "success").text(result);
}

function clearResultBlock()
{
    $("#res-block").empty().attr("class", "");
}

function parseJson(json)
{
    var data = {};
    try {
        console.log(json);
        data = $.parseJSON(json);
    } catch (e) {
        data.error_message = "Don't valid JSON";
    }
    return data;
}