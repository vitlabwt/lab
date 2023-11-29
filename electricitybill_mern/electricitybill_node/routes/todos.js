const express = require("express");
const router = express.Router();

//import controller
const { getBill } = require("../controllers/createTodo");


//define APi routes
router.post("/getBill", getBill);

module.exports = router;