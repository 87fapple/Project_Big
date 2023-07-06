const moment = require('moment');
var express = require("express");
var cors = require("cors");
var app = express();

app.use( express.static("public")  );
app.use( express.json() );
app.use( express.urlencoded( {extended: true}) );
app.use(cors());

var fs = require("fs");
var dataFileName = "./data.json";
var dataFileName2 = "./dataAweek.json";


app.listen(3000);
console.log("Web伺服器就緒，開始接受用戶端連線.");
console.log("「Ctrl + C」可結束伺服器程式.");


app.get("/todo/list", function (req, res) {
	var data = fs.readFileSync(dataFileName);
	var todoList = JSON.parse(data);
    res.set('Content-type', 'application/json');
	res.send( JSON.stringify(todoList) );
})

app.get("/todo/aweekList", function (req, res) {
	var data = fs.readFileSync(dataFileName2);
	var todoList = JSON.parse(data);
    res.set('Content-type', 'application/json');
	res.send( JSON.stringify(todoList) );
})