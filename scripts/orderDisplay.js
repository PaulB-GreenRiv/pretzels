/**
 * This function is used to show and hide appropriate content on order page when Pretzel Type are selected.
 * @param selector is the current input field. Used word this to refer to current input (onclick="showContent(this)")
 */
function showContent(selector)
{
    document.getElementById("stuffed_div").style.display = (selector.value).trim() === "Stuffed" ? 'block' : 'none';
    document.getElementById("bites_div").style.display = (selector.value).trim() === "Bitesize" ? 'block' : 'none';
}

function updateOrdSumm(fieldData, field)
{
    // Grabs default cost from HTML (0.00)
    let cost = document.getElementById("pretzelCost").innerText;
    cost = cost.substring(1, cost.length).trim();
    cost = parseFloat(cost);

    // Type costs
    if (field === 'type') {
        if ((fieldData.value).trim() === "Regular") {cost = 1.00}       // Regular
        else if ((fieldData.value).trim() === "Stuffed") {cost = 2.00}  // Stuffed
        else {cost = 1.00}                                              // Bitesize

        //Display progress
        document.getElementById("getType").innerHTML = "Pretzel Type: " + (fieldData.value).trim();
    }

    // Whole wheat cost ($1 whole wheat)
    if (field === 'wholeWheat') {
        let getCheckBox = document.getElementById("isWholeWheat").checked;
        if (getCheckBox) {
            cost += 1.00
            document.getElementById("getWheat").innerHTML = "Whole Wheat: True";
        }
        else {
            cost -= 1.00
            document.getElementById("getWheat").innerHTML = "Whole Wheat: False";
        }
    }

    // Toppings ($0.25 per topping)
    if (field === 'toppings') {
        let getVal = fieldData.value;

        if (fieldData.checked) {
            cost += 0.25
            document.getElementById("getToppings").innerHTML += (getVal + " ");
        }
        else {
            cost -= 0.25;
            document.getElementById("getToppings").innerText -= getVal;
        }

    }

    // Stuffing Cost

    // Sauce Cost

    // Amount cost ($0.20 per regular, $0.25 per whole wheat)
    if (field === "amount") {
        let totCost = 0.00;
        if (document.getElementById("isWholeWheat").checked) {
            totCost = (fieldData.value * 0.25);
        }
        else {
            totCost = (fieldData.value * 0.20);
        }
        cost += totCost;
        document.getElementById("getAmount").innerText = "Amount: " + fieldData.value;
    }

    let costDisplay = "$" + cost.toFixed(2);
    document.getElementById("pretzelCost").innerText = costDisplay;
}