/**
 * This function is used to show and hide appropriate content on order page when Pretzel Type are selected.
 * @param selector is the current input field. Used word this to refer to current input (onclick="showContent(this)")
 */
function showContent(selector)
{
    document.getElementById("stuffed_div").style.display = document.getElementById("Stuffed").checked ? 'block' : 'none';
    document.getElementById("bites_div").style.display = document.getElementById("Bitesize").checked ? 'block' : 'none';
}