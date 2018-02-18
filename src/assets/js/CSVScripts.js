function writeCSV (drawData) {
  var fs = require('browserify-fs');
  var fileName = "drawresults.csv";
  var json2csv = require('json2csv');

  var fields = ['drawTime', 'drawResult','mainBallsDrawn','powerballBallsDrawn'];
  
  var toCsv = {
      data: drawData,
      fields: fields,
      hasCSVColumnTitle: false
  };
  
  fs.stat('drawresults.csv', function (err, stat) {
      if (err == null) {
          var csv = json2csv(toCsv) + "\r\n";
          fs.appendFile('file.csv', csv, function (err) {
              if (err) throw err;
          });
      }
      else {
          //write the headers and newline
          fields= (fields + newLine);
          fs.writeFile('file.csv', fields, function (err, stat) {
              if (err) throw err;
          });
      }
  });
}

export {writeCSV}