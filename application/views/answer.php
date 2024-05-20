<?php include 'header.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Answer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .question {
        margin-bottom: 20px;
    }

    .main-content {
        margin-left: 220px;
        padding: 20px;
    }

    .vote-icons {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .upvote-icon,
    .downvote-icon {
        font-size: 24px;
        cursor: pointer;
    }

    .upvote-icon:hover,
    .downvote-icon:hover {
        color: #007bff;
    }

    .answer-textarea {
        width: 100%;
        height: 200px;
        margin-top: 20px;
    }

    .answer-btn {
        margin-top: 10px;
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        vertical-align: top;
    }

    /* Upvote and downvote icons */
    .upvote-icon,
    .downvote-icon {
        font-size: 20px;
        cursor: pointer;
        color: #666;
        margin: 5px 0;
        transition: color 0.3s;
    }

    #vote-count {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin: 5px;
    }

    .answer-content {
        display: flex;
        align-items: center;
        margin-left: 60px;
    }

    .answer-item {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        margin: 10px 0;
    }

    .accept-icon {
        color: #0DC601;
        cursor: pointer;
        border: 2px solid black;
        border-radius: 50%;
        padding: 4px;
    }

    .answer-border {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        background-color: #DEECFF;
    }

    .comment-section {
        margin-top: 10px;
    }

    .comment-textarea {
        width: 100%;
        height: 60px;
        padding: 10px;
        margin-bottom: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: vertical;
    }

    .comment-btn {
        display: inline-block;
        padding: 8px 12px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .comment-btn:hover {
        background-color: #218838;
    }

    .accept-answer {
        background-color: #0096FE;
        color: white;
        text-align: center;
        cursor: pointer;
        border-radius: 5px;
    }

    .accept-answer:hover {
        background-color: #0077CA;
    }
    </style>
</head>

<body>
    <div class="main-content">
        <div class='question'>
            <h3><?= $title; ?></h3>
        </div>
        <hr>
        <table>
            <tr>
                <th>
                    <div class="vote-icons">
                        <i id="question-upvote" class=" fas fa-arrow-up upvote-icon"></i>
                    </div>
                </th>
                <td rowspan="2">
                    <h5><?= $body; ?></h5>
                </td>
            </tr>
            <tr>
                <th>
                    <p id='vote-count'><?= $votes; ?></p>
                </th>
            </tr>
            <tr>
                <th>
                    <div class="vote-icons">
                        <i id="question-downvote" class="fas fa-arrow-down downvote-icon"></i>
                    </div>
                </th>
                <td rowspan="2">
                    <p>Added By : <?= $username ?> - Posted At : <?= $posted_at ?></p>

                </td>
            </tr>
        </table>
        <hr>
        <h4>Answers</h4>
        <div class="answers"></div>

        <h5>Your Answer</h5>
        <form class="answer-form">
            <textarea class="answer-textarea" name="body" placeholder="Type your answer here"></textarea>
            <button type="submit" class="answer-btn">Post Answer</button>
        </form>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.1/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.4.0/backbone-min.js"></script>
    <?php
$auth_user_details = $this->session->userdata('auth_user');
                    $logged_username = $auth_user_details['username'];
                    ?>
    <script>
    var questionOwner = '<?= $username; ?>';
    var logged_username = '<?= $logged_username; ?>';

    var QuestionVoteModel = Backbone.Model.extend({
        url: ' QuestionController/update_vote_count',
        upvote: function() {
            this.set('votes', this.get('votes') + 1);
            this.saveVote();
        },
        downvote: function() {
            this.set('votes', this.get('votes') - 1);
            this.saveVote();
        },
        saveVote: function() {
            var formData = {
                id: this.get('id'),
                votes: this.get('votes'),
                owner: '<?= $username; ?>'
            };

            this.save(formData, {
                success: function(model, response) {
                    alert(response['message']);
                },
                error: function(model, response) {
                    alert('Error saving vote:', response['message']);
                }
            });
        }
    });

    // Define a Backbone View
    var QuestionVoteView = Backbone.View.extend({
        el: '.main-content',
        events: {
            'click #question-upvote': 'handleUpvote',
            'click #question-downvote': 'handleDownvote'
        },
        initialize: function() {
            this.listenTo(this.model, 'change:votes', this.updateVoteCount);
            this.updateVoteCount();
        },
        handleUpvote: function() {
            this.model.upvote();
        },
        handleDownvote: function() {
            this.model.downvote();
        },
        updateVoteCount: function() {
            this.$('#vote-count').text(this.model.get('votes'));
        }
    });

    // Instantiate the model with initial
    var voteModel = new QuestionVoteModel({
        id: <?= $question_id; ?>,
        votes: <?= $votes; ?>
    });
    // Instantiate the view with the model
    var voteView = new QuestionVoteView({
        model: voteModel
    });

    /////////////////////////////////////////////////////////////////////////////////////////////////////

    var AnswerModel = Backbone.Model.extend({
        defaults: {
            body: '',
            votes: 0,
            is_accepted: 0,
            username: '',
            posted_at: ''
        },

        upvote: function() {
            this.set('votes', parseInt(this.get('votes'), 10) + 1);
            this.saveVote();
        },

        downvote: function() {
            this.set('votes', parseInt(this.get('votes'), 10) - 1);
            this.saveVote();
        },
        saveVote: function() {
            var formData = {
                id: this.get('id'),
                votes: this.get('votes'),
            };

            this.save(formData, {
                url: 'AnswerController/update_vote_count',
                success: function(model, response) {
                    console.log('Vote saved successfully:', response);
                },
                error: function(model, response) {
                    console.error('Error saving vote:', response);
                }
            });
        }
    });

    var AnswerView = Backbone.View.extend({
        tagName: 'div',

        template: _.template(`
                <div class="answer-border">
                    <table>
                        <tr>
                            <th>
                                <div class="vote-icons">
                                    <i class="fas fa-arrow-up upvote-icon"></i>
                                </div>
                            </th>
                            <td rowspan="2">
                                <p><%= body %></p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <p class='vote-count'><%= votes %></p>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="vote-icons">
                                    <i class="fas fa-arrow-down downvote-icon"></i>
                                </div>
                            </th>
                            
                        </tr>
                        <tr>
                            <th>
                            <% if (is_accepted == 1) { %>
                            <i class="fas fa-check accept-icon"></i>
                            <% } else if (questionOwner == logged_username) { %>
                            <button class="accept-answer">Accept</button>
                            <% } %>
                            </th>
                            <td>
                                <p>Added By: <%= username %> - Posted At: <%= posted_at %></p>
                            </td>
                        </tr>
                    </table>
                    <div class="comment-section">
                    <textarea class="comment-textarea" placeholder="Add a comment"></textarea>
                    <button class="comment-btn">Post Comment</button>
                    </div>
                    </div><br><br>
                    `),

        events: {
            'click .upvote-icon': 'upvote',
            'click .downvote-icon': 'downvote',
            'click .accept-answer': 'acceptAnswer',
            'click .comment-btn': 'postComment'
        },

        initialize: function() {
            this.listenTo(this.model, 'change:votes', this.render);
            this.listenTo(this.model, 'change:is_accepted', this.render);

        },

        render: function() {
            this.$el.html(this.template(_.extend(this.model.toJSON(), {
                logged_username: logged_username,
                questionOwner: questionOwner
            })));
            return this;
        },

        upvote: function() {
            this.model.upvote();
        },

        downvote: function() {
            this.model.downvote();
        },

        acceptAnswer: function() {
            var formData = {
                id: this.model.get('id'),
                is_accepted: 1
            };

            this.model.save(formData, {
                url: 'AnswerController/accept_answer',
                success: function(model, response) {
                    console.log('Answer accepted successfully:', response);
                },
                error: function(model, response) {
                    console.error('Error accepting answer:', response);
                }
            });
        },

        postComment: function() {
            var commentText = this.$('.comment-textarea').val().trim();
            if (!commentText) return;

            var commentData = {
                answer_id: this.model.get('answer_id'),
                comment: commentText,
            };

            this.model.save(commentData, {
                url: 'CommentController/add_comment',
                success: function(model, response) {
                    console.log('Vote saved successfully:', response);
                },
                error: function(model, response) {
                    console.error('Error saving vote:', response);
                }
            });
            this.$('.comment-textarea').val('');
        }
    });

    var AnswersCollection = Backbone.Collection.extend({
        url: function() {
            return 'AnswerController/get_answers_byId/' + this.questionId;
        },
        initialize: function(models, options) {
            this.questionId = options.questionId;
        },
        model: AnswerModel
    });

    var AnswersListView = Backbone.View.extend({
        el: '.answers',
        initialize: function() {
            this.listenTo(this.collection, 'sync', this.render);
            this.collection.fetch();
        },

        render: function() {
            this.$el.empty();
            this.collection.each(this.renderAnswer, this);
        },

        renderAnswer: function(answer) {
            var answerView = new AnswerView({
                model: answer
            });
            this.$el.append(answerView.render().el);
        }
    });

    ////////////////////////////////////////////////////////////////////////////////

    var AnswerFormView = Backbone.View.extend({
        el: '.answer-form',

        events: {
            'submit': 'submitAnswer'
        },

        initialize: function() {
            this.$bodyInput = this.$('.answer-textarea');
            this.$submitButton = this.$('.answer-btn');
        },

        submitAnswer: function(event) {
            event.preventDefault();

            var body = this.$bodyInput.val().trim();
            if (!body) return;

            var answer = new AnswerModel({
                body: body,
                question_id: '<?= $question_id; ?>',
            });

            this.collection.add(answer);

            answer.save(null, {
                url: 'AnswerController/add_answer',
                success: function(model, response) {
                    console.log('Form submitted successfully:', response);
                },
                error: function(model, response) {
                    console.error('Error submitting form:', response);
                }
            });
            this.$bodyInput.val('');
        }
    });

    // Instantiate the answers collection
    var answersCollection = new AnswersCollection([], {
        questionId: '<?= $question_id; ?>'
    });

    // Instantiate the answers list view
    var answersListView = new AnswersListView({
        collection: answersCollection
    });

    // Instantiate the answer form view
    var answerFormView = new AnswerFormView({
        collection: answersCollection
    });
    </script>
</body>

</html>