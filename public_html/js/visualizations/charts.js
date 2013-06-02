google.load('visualization', '1.0', {'packages':['corechart']});
              var dtTable;
              var objPurityResult = {}; 
         
              //Get jSON data 
              $.ajax({
                    url: "data/data.json",
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                         objPurityResult = data;
                    }
               });  
               
               //Draw Pie Chart
               // Set a callback to run when the Google Visualization API is loaded.
               google.setOnLoadCallback(drawPieChart);
               function drawPieChart() {
                     // Create the data table and populate it with the water purity data .
                     dtTable = new google.visualization.DataTable();
                     console.log(objPurityResult);
                     dtTable.addColumn('string', 'Contaminant Type');
                     dtTable.addColumn('number', 'Amount in Area');
                      for (var i in objPurityResult) {
                           dtTable.addRows([
                                 [objPurityResult[i].CNAME, parseInt(objPurityResult[i].cnt)]
                          ]);
                     }
                    
                     // Set chart options
                     var options = {'title':'Contaminants in the Zip Code 30901', 'width':450, 'height':350};
                     
                     // Instantiate and draw our chart, passing in some options.
                     var pieChartData = new google.visualization.PieChart(document.getElementById('pieChart'));
                     pieChartData.draw(dtTable, options);
               }
               
               //Draw Bar Chart
               // Set a callback to run when the Google Visualization API is loaded.
               google.setOnLoadCallback(drawBarChart);
               function drawBarChart() {
                     // Create the data table and populate it with the water purity data .
                     dtTable = new google.visualization.DataTable();
                     console.log(objPurityResult);
                     dtTable.addColumn('string', 'Contaminant Type');
                     dtTable.addColumn('number', 'Amount in Area');
                      for (var i in objPurityResult) {
                           dtTable.addRows([
                                 [objPurityResult[i].CNAME, parseInt(objPurityResult[i].cnt)]
                          ]);
                     }
                    
                     // Set chart options
                     var options = {'title':'Contaminants in the Zip Code 30901', 'width':450, 'height':350};
                     
                     // Instantiate and draw our chart, passing in some options.                     
                     var barChartData = new google.visualization.ColumnChart(document.getElementById('barChart'));
                     barChartData.draw(dtTable, options);
               }
               
               //Draw Stepped Chart
               // Set a callback to run when the Google Visualization API is loaded.
               google.setOnLoadCallback(drawSteppedChart);
               function drawSteppedChart() {
                     // Create the data table and populate it with the water purity data .
                     dtTable = new google.visualization.DataTable();
                     console.log(objPurityResult);
                     dtTable.addColumn('string', 'Contaminant Type');
                     dtTable.addColumn('number', 'Amount in Area');
                      for (var i in objPurityResult) {
                           dtTable.addRows([
                                 [objPurityResult[i].CNAME, parseInt(objPurityResult[i].cnt)]
                          ]);
                     }
                    
                     // Set chart options
                     var options = {'title':'Contaminants in the Zip Code 30901', 'width':450, 'height':350};
                     
                     // Instantiate and draw our chart, passing in some options.                     
                     var steppedChartData = new google.visualization.SteppedAreaChart(document.getElementById('steppedChart'));
                     steppedChartData.draw(dtTable, options);
               }