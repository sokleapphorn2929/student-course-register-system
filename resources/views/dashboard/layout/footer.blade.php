    <script>
        document.addEventListener('input', function (e) {

            // Table search
            if (e.target.id === 'studentTableSearch') {
                const search = e.target.value.toLowerCase();
                document.querySelectorAll('#searchTableBody > tr').forEach(row => {
                    const cells = Array.from(row.querySelectorAll('td:not(:last-child)'));
                    const text = cells.map(td => td.textContent).join(' ').toLowerCase();
                    row.style.display = text.includes(search) ? '' : 'none';
                });
            }

            if (e.target.matches('[id^="studentSearch_"]')) {
                const search = e.target.value.toLowerCase();
                const suffix = e.target.id.replace('studentSearch_', '');
                const select = document.getElementById('studentSelect_' + suffix);
                if (!select) return;
                select.querySelectorAll('option').forEach(option => {
                    option.style.display = option.text.toLowerCase().includes(search) ? '' : 'none';
                });
            }

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>