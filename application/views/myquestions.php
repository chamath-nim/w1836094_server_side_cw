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

    .main-content {
        margin-left: 220px;
        padding: 20px;
    }

    button {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        margin: 5px;
    }

    .delete-question-btn {
        background-color: #e74c3c;
        color: white;
        transition: background-color 0.3s ease;
    }

    .delete-question-btn:hover {
        background-color: #c0392b;
    }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="question-header">
            <h1 class="text-capitalize">My Questions</h1>
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
        urlRoot: 'QuestionController/delete_question',
        idAttribute: 'question_id'
    });
    // Backbone Collection for Questions
    var QuestionCollection = Backbone.Collection.extend({
        url: 'QuestionController/getAll_myquestions',
        model: QuestionModel
    });

    // Backbone View for displaying a single Question
    var QuestionView = Backbone.View.extend({
        tagName: 'div',
        className: 'question-container',

        template: _.template(`
        <div class="question">
            <hr>
            <a href="question<%= question_id %>"><h6><%= title %></h6></a>
            <p><%= body %></p>
            <p>| Votes: <%= votes %></p>
            <button class="delete-question-btn">Delete</button>
        </div>
    `),

        events: {
            'click .delete-question-btn': 'deleteQuestion'
        },

        deleteQuestion: function() {
            var self = this;
            this.model.destroy({
                url: this.model.urlRoot + '/' + this.model.get(
                    'question_id'), // Correct URL for DELETE request
                success: function(model, response) {
                    console.log('Question deleted successfully:', response);
                    self.remove(); // Remove the view from the DOM
                },
                error: function(model, response) {
                    console.error('Error deleting question:', response);
                }
            });
        },

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
            this.listenTo(this.collection, 'reset', this
                .render); // Use 'reset' event for better performance
            this.collection.fetch({
                reset: true
            });
        },

        render: function() {
            this.$el.empty();
            this.collection.each(this.renderQuestion, this);
            return this;
        },

        renderQuestion: function(question) {
            var questionView = new QuestionView({
                model: question
            });
            this.$el.append(questionView.render().el);
        }
    });

    // Instantiate the list view to load the questions on page load
    var questionListView = new QuestionListView();
    </script>
</body>

</html>