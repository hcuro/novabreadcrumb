Nova.booting((app, store) => {
  app.component('nova-breadcrumb', require('./components/Card.vue').default);
  app.component('nova-text-card', require('./components/TextCard.vue').default);
});
