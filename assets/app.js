/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

require("bootstrap");

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

import { Toast } from "bootstrap";

const answer1Div = document.getElementById('answer1');
const answer2Div = document.getElementById('answer2');
const answer3Div = document.getElementById('answer3');
const answer4Div = document.getElementById('answer4');
const correctAnswerDiv = document.getElementById('correctAnswerDiv');
const correctAnswerToast = document.getElementById('correctAnswerToast')
const wrongAnswerToast = document.getElementById('wrongAnswerToast')
let correctAnswer = correctAnswerDiv.textContent;
let answer = '';

function changeOptionsColor() {
    switch (correctAnswer) {
        case '1':
            answer1Div.classList.add('correct');
            answer2Div.classList.add('wrong');
            answer3Div.classList.add('wrong');
            answer4Div.classList.add('wrong');
            break;
        case '2':
            answer1Div.classList.add('wrong');
            answer2Div.classList.add('correct');
            answer3Div.classList.add('wrong');
            answer4Div.classList.add('wrong');
            break;
        case '3':
            answer1Div.classList.add('wrong');
            answer2Div.classList.add('wrong');
            answer3Div.classList.add('correct');
            answer4Div.classList.add('wrong');
            break;
        case '4':
            answer1Div.classList.add('wrong');
            answer2Div.classList.add('wrong');
            answer3Div.classList.add('wrong');
            answer4Div.classList.add('correct');
            break;
        default:
            break;
    }
}

if (answer1Div && answer2Div && answer3Div && answer4Div && correctAnswerDiv) {
    answer1Div.addEventListener('click', function () {
        answer = '1';
        if (answer == correctAnswer) {
            const toast = new Toast(correctAnswerToast);
            toast.show();
            changeOptionsColor();
        } else {
            const toast = new Toast(wrongAnswerToast)
            toast.show()
            changeOptionsColor();
        }
    })
    answer2Div.addEventListener('click', function () {
        answer = '2';
        if (answer == correctAnswer) {
            const toast = new Toast(correctAnswerToast);
            toast.show();
            changeOptionsColor();
        } else {
            const toast = new Toast(wrongAnswerToast)
            toast.show()
            changeOptionsColor();
        }
    })
    answer3Div.addEventListener('click', function () {
        answer = '3';
        if (answer == correctAnswer) {
            const toast = new Toast(correctAnswerToast);
            toast.show();
            changeOptionsColor();
        } else {
            const toast = new Toast(wrongAnswerToast)
            toast.show()
            changeOptionsColor();
        }
    })
    answer4Div.addEventListener('click', function () {
        answer = '4';
        if (answer == correctAnswer) {
            const toast = new Toast(correctAnswerToast);
            toast.show();
            changeOptionsColor();
        } else {
            const toast = new Toast(wrongAnswerToast)
            toast.show()
            changeOptionsColor();
        }
    })
}
