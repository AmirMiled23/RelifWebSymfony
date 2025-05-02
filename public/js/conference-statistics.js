document.addEventListener('DOMContentLoaded', function() {
    // Don't create any HTML elements since they're now in the template
    // Just initialize the charts
    
    // Load Chart.js if needed
    if (typeof Chart === 'undefined') {
        console.log('Loading Chart.js');
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js';
        script.onload = initializeCharts;
        document.head.appendChild(script);
    } else {
        initializeCharts();
    }
    
    // Initialize charts
    function initializeCharts() {
        console.log('Initializing charts');
        // Use mock data for now
        const data = getMockData();
        
        // Set up tab change events to load charts when tabs are clicked
        document.querySelectorAll('button[data-bs-toggle="tab"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', function (event) {
                const targetId = event.target.getAttribute('data-bs-target').substring(1);
                if (targetId === 'overview') renderOverviewCharts(data);
                if (targetId === 'themes') renderThemeCharts(data);
                if (targetId === 'locations') renderLocationCharts(data);
                if (targetId === 'revenue') renderRevenueCharts(data);
            });
        });
        
        // Immediately render the overview charts
        renderOverviewCharts(data);
    }
    
    // Overview tab charts
    function renderOverviewCharts(data) {
        const monthlySummaryCtx = document.getElementById('monthlySummaryChart');
        if (monthlySummaryCtx) {
            // Check if chart already exists and destroy it
            if (monthlySummaryCtx.chart) {
                monthlySummaryCtx.chart.destroy();
            }
            
            // Create new chart
            const chart = new Chart(monthlySummaryCtx, {
                type: 'line',
                data: {
                    labels: data.monthly.labels,
                    datasets: [{
                        label: 'Conferences',
                        data: data.monthly.conferences,
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
            
            // Store chart instance for later reference
            monthlySummaryCtx.chart = chart;
        }
        
        const statusPieCtx = document.getElementById('statusPieChart');
        if (statusPieCtx) {
            new Chart(statusPieCtx, {
                type: 'doughnut',
                data: {
                    labels: data.status.labels,
                    datasets: [{
                        data: data.status.counts,
                        backgroundColor: ['#198754', '#ffc107', '#6c757d'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    },
                    cutout: '60%'
                }
            });
        }
    }
    
    // Render theme charts
    function renderThemeCharts(data) {
        // Implementation for theme charts
        console.log('Theme charts would be rendered here');
    }
    
    // Render location charts
    function renderLocationCharts(data) {
        // Implementation for location charts
        console.log('Location charts would be rendered here');
    }
    
    // Render revenue charts
    function renderRevenueCharts(data) {
        // Implementation for revenue charts
        console.log('Revenue charts would be rendered here');
    }
    
    // Mock data for development and testing
    function getMockData() {
        return {
            monthly: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                conferences: [5, 8, 12, 10, 15, 20, 18, 22, 25, 28, 20, 15]
            },
            status: {
                labels: ['En cours', 'Pas encore', 'Autres'],
                counts: [45, 65, 10]
            },
            themes: {
                labels: ['Technology', 'Business', 'Science', 'Art', 'Health', 'Environment', 'Others'],
                counts: [30, 25, 15, 10, 12, 8, 20]
            },
            // ...other mock data
        };
    }
    
    // Modal initialized event
    const modalElement = document.getElementById('statisticsModal');
    if (modalElement) {
        modalElement.addEventListener('shown.bs.modal', function () {
            console.log('Statistics modal shown');
            // Resize charts when modal is shown
            window.dispatchEvent(new Event('resize'));
        });
    }
    
    // Download report functionality
    const downloadBtn = document.getElementById('downloadStats');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function() {
            // You can implement report download functionality here
            alert('Download report functionality will be implemented here.');
        });
    }
});
