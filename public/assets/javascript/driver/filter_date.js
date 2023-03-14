// Optional JavaScript code to validate date input and prevent the user from selecting an invalid date range
const fromDate = document.getElementById("from-date");
const toDate = document.getElementById("to-date");

if (fromDate && toDate) {
    toDate.addEventListener("change", () => {
        if (toDate.value < fromDate.value) {
            fromDate.value = toDate.value;
        }
    });

    fromDate.addEventListener("change", () => {
        if (fromDate.value > toDate.value) {
            toDate.value = fromDate.value;
        }
    });
} else {
    console.error("Could not find one or both of the date inputs.");
}


