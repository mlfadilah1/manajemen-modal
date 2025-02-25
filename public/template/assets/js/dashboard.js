$(function () {
  // =====================================
  // Profit Chart
  // =====================================
  let profitChartElement = document.querySelector("#chart");
  if (profitChartElement) {
      let profitChart = new ApexCharts(profitChartElement, {
          series: [
              { name: "Earnings this month:", data: [355, 390, 300, 350, 390, 180, 355, 390] },
              { name: "Expense this month:", data: [280, 250, 325, 215, 250, 310, 280, 250] }
          ],
          chart: { type: "bar", height: 345, toolbar: { show: true } },
          colors: ["#5D87FF", "#49BEFF"],
          plotOptions: { bar: { columnWidth: "35%", borderRadius: [6] } },
          xaxis: { categories: ["16/08", "17/08", "18/08", "19/08", "20/08", "21/08", "22/08", "23/08"] },
          yaxis: { min: 0, max: 400, tickAmount: 4 },
          stroke: { show: true, width: 3, colors: ["transparent"] }
      });
      profitChart.render();
  }

  // =====================================
  // Breakup Chart
  // =====================================
  let breakupChartElement = document.querySelector("#breakup");
  if (breakupChartElement) {
      let breakupChart = new ApexCharts(breakupChartElement, {
          series: [38, 40, 25],
          labels: ["2022", "2021", "2020"],
          chart: { type: "donut", width: 180 },
          colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"]
      });
      breakupChart.render();
  }

  // =====================================
  // Earning Chart
  // =====================================
  let earningChartElement = document.querySelector("#earning");
  if (earningChartElement) {
      let earningChart = new ApexCharts(earningChartElement, {
          series: [{ name: "Earnings", color: "#49BEFF", data: [25, 66, 20, 40, 12, 58, 20] }],
          chart: { type: "area", height: 60 },
          stroke: { curve: "smooth", width: 2 },
          fill: { colors: ["#f3feff"], opacity: 0.05 }
      });
      earningChart.render();
  }
});

// =====================================
// Analisis Chart
// =====================================
function renderAnalisisChart(data) {
  let analisisChartElement = document.querySelector("#analisisChart");
  if (!analisisChartElement) {
      console.error("Element #analisisChart tidak ditemukan!");
      return;
  }

  let analisisChart = new ApexCharts(analisisChartElement, {
      chart: { type: 'line', height: 350 },
      series: [
          { name: "BEP Unit", data: data.bepUnit },
          { name: "BEP Rupiah", data: data.bepRupiah },
          { name: "Laba Bersih", data: data.labaBersih },
          { name: "ROI (%)", data: data.roi }
      ],
      xaxis: { categories: data.labels },
      stroke: { width: 2, curve: 'smooth' },
      colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560']
  });
  analisisChart.render();
}
