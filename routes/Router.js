const express = require('express');
const router = express.Router();
const StudentsData = require('../students/students');

router.post('/post', async(req,res)=> {
    try{
        const data = req.body;

        const subjectArray = Object.keys(data.subject).map(key => {
            const subject = data.subject[key];
            return{
                paper: subject.paper
            }
        });

        const paymentArray = Object.keys(data.payment).map(key => {
            const payment = data.payment[key];
            return{
                semester_no: payment.semester_no,
                payment_details: payment.payment_details,
                fee: payment.fee,
                fee_status: payment.fee_status
            };
        });

        const memberData = {
            ...data,
            subject: subjectArray,
            payment: paymentArray
        };

        const member = new StudentsData(memberData);
        const newMember = await member.save();
        console.log("Student data saved successfully");
        res.status(201).json(newMember);
    } catch (err){
        console.error("Error in saving data ", err);
        res.status(400).json({message: err.message});
    }
});


router.get('/login/:register_no', async(req,res)=>{
    const { register_no } = req.params;
    try{
        const student = await StudentsData.findOne({register_no: register_no});
        if(!student){
            return res.status(404).json({message: "student not found"});
        }
        else{
            return res.status(201).json(student);
        }
    } catch(err){
        console.error("Error occured while fetching ", err);
        res.status(400).json({message: err.message})
    }
});

router.delete('/delete/:register_no', async(req,res)=>{
    const { register_no } = req.params;
    try{
        const student = await StudentsData.deleteOne({register_no: register_no});
        if(!student){
            return res.status(404).json({message: "student not found"});
        }
        else{
            return res.status(201).json({message: "student data deleted successfully"});
        }
    } catch(err){
        console.error("Error in deleting student data");
        return res.status(400).json({message: err.message});
    }
});

router.get('/getdata', async(req,res)=>{
    try{
        const students = await StudentsData.find();
        if(!students){
            console.error("No data found");
            res.status(404).json({mesage: "No data available"});
        }
        else{
            console.log("Fetched students: ", students);
            res.status(201).json({students});
        }
    } catch(err){
        console.error("Error in fetching data", err);
        res.status(400).json({message: err.message})
    }
})

module.exports = router;