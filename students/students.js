const mongoose = require('mongoose');

const memberSchema = new mongoose.Schema({
    umis_no: {type: Number, required: true},
    emis_no: {type: Number, required: true},

    subject: [
    { paper: {type: String, required: true}},
    ],

    payment: [
        {
            semester_no: {type: Number, required: true},
            payment_details: {type: String, required: true},
            fee: {type: Number, required: true},
            fee_status: {type: String, required: true}
        }
    ],

    email: {type: String, required: true},
    phone_no: {type: Number, required: true},
    alternative_no: {type: Number, required: true},

    register_no: {type: String, required: true},
    password: {type: String, required: true},
    student_name: {type: String, required: true},
    aadhar_no: {type: Number, required: true},
    data_of_birth: {type: String, required: true},
    gender: {type: String, required: true},
    father_name: {type: String, required: true},
    nationality: {type: String, required: true},
    religion: {type: String, required: true},
    catholic: {type: String, required: true},
    dalit: {type: String, required: true},
    community: {type: String, required: true},
    caste: {type: String, required: true},
    handicapped: {type: String, required: true},
    handicap_info: {type: String, required: true},
    state: {type: String, required: true}
});

module.exports = mongoose.model('students', memberSchema);