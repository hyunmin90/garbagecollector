App = Ember.Application.create({});

App.Router.map(function() {
  this.resource('php');
  this.resource('Nodejs');
  this.resource('jsp');
  this.resource('Django');
  this.resource('Ruby');
  this.resource('intro');
  this.resource('listvm');
});

App.PostsRoute = Ember.Route.extend({
  model: function() {
    return posts;
  }
});















var showdown = new Showdown.converter();

Ember.Handlebars.helper('format-markdown', function(input) {
  return new Handlebars.SafeString(showdown.makeHtml(input));
});

Ember.Handlebars.helper('format-date', function(date) {
  return moment(date).fromNow();
});
