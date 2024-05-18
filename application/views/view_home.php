<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
    .question-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .ask-question-btn,
    .answer-btn {
        order: 1;
        margin-right: 20px;
        border: none;
        color: white;
        padding: 7px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        cursor: pointer;
        border-radius: 8px;
    }

    .ask-question-btn {
        background-color: #4CAF50;
    }

    .ask-question-btn:hover {
        background-color: #45a049;
    }

    .answer-btn {
        background-color: royalblue;
    }

    .popup-form {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .popup-form button[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .popup-form input[type="text"],
    .popup-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .popup-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }

    .main-content {
        margin-left: 220px;
        padding: 20px;
    }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="question-header">
            <h1 class="text-capitalize">Questions</h1>
            <button class="ask-question-btn">Ask Question</button>
        </div>

        <div class="popup-background" id="popupBackground" style="display: none;"></div>
        <div class="popup-form" id="popupForm" style="display: none;">
            <form action="questions" method="POST">
                <label for="title">Question </label>
                <input type="text" id="title" name="title" required>
                <label for="body">Details of the problem</label>
                <textarea id="body" name="body" rows="4" required></textarea>
                <label for="tags">Tags </label>
                <input type="text" id="tags" name="tags" required>
                <button type="submit">Submit</button>
            </form>
        </div>

        <div id="questionList">
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
    <script>
    // Backbone Model
    var QuestionModel = Backbone.Model.extend({
        url: 'QuestionController/create_question'
    });

    // Backbone View for the form
    var QuestionFormView = Backbone.View.extend({
        el: '.main-content',

        events: {
            'click .ask-question-btn': 'togglePopupForm',
            'click .popup-background': 'closePopupForm',
            'submit form': 'submitForm'
        },

        initialize: function() {
            this.$popupForm = this.$('#popupForm');
            this.$popupBackground = this.$('#popupBackground');
            _.bindAll(this, 'togglePopupForm', 'closePopupForm', 'submitForm');
        },

        togglePopupForm: function() {
            this.$popupForm.toggle();
            this.$popupBackground.toggle();
        },

        closePopupForm: function() {
            this.$popupForm.hide();
            this.$popupBackground.hide();
        },

        clearForm: function() {
            this.$('#title').val('');
            this.$('#body').val('');
            this.$('#tags').val('');
        },

        submitForm: function(event) {
            event.preventDefault();

            var formData = {
                title: this.$('#title').val(),
                body: this.$('#body').val(),
                tags: this.$('#tags').val()
            };

            var question = new QuestionModel(formData);

            var self = this;
            question.save(null, {
                success: function(model, response) {
                    console.log('Form submitted successfully:', response);
                    self.closePopupForm();
                    self.clearForm();
                    questionListView.collection.fetch({
                        reset: true
                    });
                },
                error: function(model, response) {
                    console.error('Error submitting form:', response);
                }
            });

            this.togglePopupForm();
        }
    });

    // Backbone Collection for Questions
    var QuestionCollection = Backbone.Collection.extend({
        url: 'QuestionController/getAll_questions',
        model: QuestionModel
    });

    // Backbone View for displaying a single Question
    var QuestionView = Backbone.View.extend({
        tagName: 'div',
        // className: 'question-container',

        template: _.template(`
                <div class="question">
                <hr>
                <a href="question<%= question_id %>"><h6><%= title %></h6></a>
                    <p><%= body %></p>
                    <p>| Votes: <%= votes %></p>
                </div>
            `),

        render: function() {
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        }
    });

    // Backbone View for displaying a list of Questions
    var QuestionListView = Backbone.View.extend({
        el: '#questionList',

        initialize: function() {
            this.collection = new QuestionCollection();
            this.listenTo(this.collection, 'sync', this.render);
            this.collection.fetch({
                reset: true
            });
        },

        render: function() {
            this.$el.empty();
            this.collection.each(function(question) {
                var questionView = new QuestionView({
                    model: question
                });
                this.$el.append(questionView.render().el);
            }, this);
            return this;
        }
    });

    var questionFormView = new QuestionFormView();
    var questionListView = new QuestionListView();
    </script>
</body>

</html>