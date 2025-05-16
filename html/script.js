const button = document.getElementById('submitBtn');
const string = /^[A-Za-zஅ-ஹஂஃ\s.'-]+$/;
const number = /^[0-9]+$/;
const phoneRegex = /^[6-9]\d{9}$/;
const addressRegex = /^[0-9A-Za-zஅ-ஹஂஃ\s,.'-]+$/; 

const clearBtn = document.getElementById('clearBtn');
clearBtn.addEventListener('click', ()=>{
    document.getElementById('form').reset();
});

button.addEventListener('click', (e) => {
    e.preventDefault();

    // Form values
    const fields = {
        applicantName: 'name',
        dob: 'dob',
        place: 'place',
        casteName: 'casteName',
        priestPlace: 'priestPlace',
        caste: 'caste',
        orphan: 'orphan',
        semiOrphan: 'semiOrphan',
        fm1: 'fm1',
        fm2: 'fm2',
        fm1Occupation: 'fm1-occupation',
        fm2Occupation: 'fm2-occupation',
        fm1Income: 'fm1-income',
        fm2Income: 'fm2-income',
        s1: 's1',
        s2: 's2',
        s3: 's3',
        s1Study: 's1-study',
        s1Year: 's1-year',
        s2Study: 's2-study',
        s2Year: 's2-year',
        s3Study: 's3-study',
        s3Year: 's3-year',
        address: 'address',
        district: 'district',
        phoneNo: 'phoneNo',
        schoolCollege: 'school-college',
        schoolCollegeAddress: 'school-college-address',
        subject: 'subject',
        years: 'years',
        currentYear: 'current-year'
    };

    const values = {};
    for (let key in fields) {
        values[key] = document.getElementById(fields[key]).value.trim();
    }

    // String validations
    const stringFields = [
        'applicantName', 'place', 'priestPlace', 'casteName', 'fm1', 'fm1Occupation',
        'fm2', 'fm2Occupation', 's1', 's1Study', 's2', 's2Study', 's3', 's3Study',
        'district', 'schoolCollege', 'subject'
    ];

    for (let field of stringFields) {
        if (!string.test(values[field])) {
            alert(`Invalid input in ${field}. It should contain only letters.`);
            document.getElementById(fields[field]).focus();
            return;
        }
    }

    if(!values.dob){
        alert("Enter your date of birth");
        return;
    }

    // Number validations
    const numberFields = ['fm1Income', 'fm2Income', 's1Year', 's2Year', 's3Year', 'years', 'currentYear'];

    for (let field of numberFields) {
        if (!number.test(values[field])) {
            alert(`Invalid input in ${field}. It should contain only numbers.`);
            document.getElementById(fields[field]).focus();
            return;
        }
    }

    if (!addressRegex.test(values.address)) {
        console.log(address.value);
    alert("Enter a valid address");
    document.getElementById(fields.address).focus();
    return;
    }
    if (!addressRegex.test(values.schoolCollegeAddress)) {
    alert("Enter a valid address");
    document.getElementById('school-college-address').focus();
    return;
    }

    // Phone number validation
    if (!phoneRegex.test(values.phoneNo)) {
        alert("Invalid phone number. It should be a 10-digit number starting with 6-9.");
        document.getElementById(fields.phoneNo).focus();
        return;
    }

        // Image validation
    const imageInput = document.getElementById('image');
    const image = imageInput.files[0];
    const validImages = ["image/jpg", "image/jpeg"];
    const maxSize = 1 * 1024 * 1024; // 1MB

    if (!image) {
        alert("Please upload your image");
        imageInput.focus();
        return;
    }

    if (!validImages.includes(image.type)) {
        alert("Only jpg, jpeg images are allowed");
        imageInput.focus();
        return;
    }

    if (image.size > maxSize) {
        alert("File size should be less than 1MB");
        imageInput.focus();
        return;
    }

    alert("Details validated successfully");
    console.log(values);
});
