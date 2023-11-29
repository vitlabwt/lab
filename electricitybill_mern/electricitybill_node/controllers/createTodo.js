
exports.getBill = async(req,res) => {
    try {
            //extract title aconsumernd desxcription from reauest body
            let {unit} = req.body;
            unit = parseInt(unit)
            console.log("num",unit)
            //create a new Todo Obj and insert in DB
            let bill = 0;
            if (unit <= 50) {
              bill = unit * 3.5;
            } else if (unit <= 150) {
              bill = 50 * 3.5 + (unit - 50) * 4.00;
            } else if (unit <= 250) {
              bill = 50 * 3.5 + 100 * 4.00 + (unit - 150) * 5.20;
            } else {
              bill = 50 * 3.5 + 100 * 4.00 + 100 * 5.20 + (unit - 250) * 6.50;
            }
            //send a json response with a success flag
            console.log(bill,"bill")
            res.status(200).json(
                {
                    success:true,
                    data:bill,
                    message:'your bill'
                }
            );
    }
    catch(err) {
        console.error(err);
        console.log(err);
        res.status(500)
        .json({
            success:false,
            data:"internal server error",
            message:err.message,
        })
    }
}