document.addEventListener("DOMContentLoaded", function() {
    const selectElement = document.getElementById("sville");

    fetch('villes.txt')
        .then(response => response.text())
        .then(text => {
            const lines = text.split('\n');
            lines.forEach(line => {
                if (line.trim()) { 
                    const option = document.createElement('option');
                    option.value = line.trim();
                    option.text = line.trim();
                    selectElement.add(option);
                }
            });
        })
        .catch(error => console.error('Error fetching options:', error));
});
