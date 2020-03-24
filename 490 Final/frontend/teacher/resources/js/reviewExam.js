var examName = "";
var studentName = "";
var question_ids = [];
var questionDB = [];

var res;

window.onload = function () {
    loggedInTeacher();
    examName = window.localStorage.getItem('examName');
    studentName = window.localStorage.getItem('studentName');
    ajaxCallTeacherReview(studentName, examName);
    document.getElementById('exam_name').innerHTML = "Exam Name: " + examName;
    document.getElementById('student_name').innerHTML = "Student Name: " + studentName;
};

function populateExam(response) {

    res = response;

    var questionDB = JSON.parse(response);
    console.log(questionDB);

    var row = questionsTable.insertRow(0);
    var question = row.insertCell(0);

    question.innerHTML = "<div>" +
        "Question"
    "</div>"

    var answer = row.insertCell(1);

    answer.innerHTML = "<div>" +
        "Answer"
    "</div>"

    var grade = row.insertCell(2);

    grade.innerHTML = "<div>" +
        "Grade"
    "</div>"

    var profComments = row.insertCell(3);

    profComments.innerHTML = "<div>" +
        "ProfComments"
    "</div>"

    var autograderComments = row.insertCell(4);

    autograderComments.innerHTML = "<div>" +
        "AutograderComments"
    "</div>"

    var q = 1;

    for (var i in questionDB) {

        var row = questionsTable.insertRow(q);
        var question = row.insertCell(0);

        question.innerHTML = "<div>" +
            questionDB[i]['question']
        "</div>"

        question.setAttribute("id", "question_id_" + i);

        var answer = row.insertCell(1);
        answer.innerHTML = "<div>" +
            questionDB[i]['answer']
        "</div>"

        answer.setAttribute("id", "answer_id_" + i);

        var a = "grade_id" + i;

        var grade = row.insertCell(2);
        grade.innerHTML = "<div>" +
            questionDB[i]['grade']
        "</div>";

        grade.setAttribute("id", "grade_id_" + i);

        var profComments = row.insertCell(3);

        var pComment = document.createElement('TEXTAREA');
        pComment.setAttribute("id","profComments_id_"+i);

        profComments.appendChild(pComment);

        var autograderComments = row.insertCell(4);

        autograderComments.innerHTML = "<textarea>" +
            "</textarea>"

        q++;

    }

}

function updateStudentExam() {

    var questionDB = JSON.parse(res);

    for (var i in questionDB) {
        var questionId = questionDB[i];
        var grade = document.getElementById("grade_id_" + i).innerHTML.replace(/<[^>]+>/g, '');
        var professorComments = document.getElementById("profComments_id_" + i).value;

        array = {
            "header": "examUpdate",
            "username": studentName,
            "examName": examName,
            "id": i,
            "grade": grade,
            "teacherNotes": professorComments
        }
        console.log(JSON.stringify(array))
        fields = JSON.stringify(array);
        ajaxUpdateExamRequest(fields);
    }
}

function ajaxUpdateExamRequest(fields) {

    var data = 'json_string=' + fields;
    console.log(data);
    var request = new XMLHttpRequest();

    request.open('POST', '../php/frontend.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
            var response = request.responseText;
            console.log(response)
            document.getElementById("status").innerHTML = "Update Complete";
        } else {
            console.log("failed to recieve PHP response")
        }
    };

}


function ajaxCallTeacherReview(username, examName) {

    var data = 'json_string={"header":"examReview","examName":"' + examName + '","username":"' + username + '"}';
    var request = new XMLHttpRequest();
    console.log(data);

    request.open('POST', '../php/frontend.php', true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    request.send(data);

    request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
            var response = request.responseText;
            populateExam(response);
        } else {
            console.log("failed to recieve PHP response")
        }
    };
}
