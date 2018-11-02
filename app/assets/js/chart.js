'use strict';

window.chartColors = {
	red: 'rgb(226, 0, 78)',
	blue: 'rgb(35, 175, 190)',
};


// Chart Settings
window.onload = function() {
	var ctx = document.getElementById('canvas').getContext('2d');
	window.myLine = Chart.Line(ctx, {
		data: lineChartData,
		options: {
			
			responsive: true,
			hoverMode: 'index',
			stacked: false,
			title: {
				display: false,
				text: 'Temperature \ Humidity Chart'
			},
			scales: {
				yAxes: [{
					type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
					display: true,
					position: 'left',
					id: 'y-axis-1',
				}, {
					type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
					display: true,
					position: 'right',
					id: 'y-axis-2',

					// grid line settings
					gridLines: {
						drawOnChartArea: false, // only want the grid lines for one axis to show up
					},
				}],
				xAxes: [{
					ticks: {
					  // Make labels vertical
					  // https://stackoverflow.com/questions/28031873/make-x-label-horizontal-in-chartjs
					  minRotation: 45,
			
					  // Limit number of labels
					  // https://stackoverflow.com/questions/22064577/limit-labels-number-on-chartjs-line-chart
					  autoSkip: false,
					  maxTicksLimit: 12}
					}],
			}
		}
	});
};


