<template>
  <div
    class="nova-text-card"
    :class="cardClasses"
    :style="cardStyles"
  >
    <!-- HTML Content -->
    <div
      v-if="card.type === 'html'"
      class="text-card-content"
      v-html="card.html"
    ></div>

    <!-- List Content -->
    <div
      v-else-if="card.type === 'list'"
      class="text-card-content"
    >
      <template v-for="(item, index) in card.items" :key="index">
        <span class="list-item">{{ item }}</span>
        <span
          v-if="index < card.items.length - 1"
          class="list-separator"
        >
          {{ separator }}
        </span>
      </template>
    </div>
  </div>
</template>

<script>
export default {
  props: ['card'],

  computed: {
    separator() {
      return this.card.separator || ', ';
    },
    cardStyles() {
      const styles = {};

      // Handle custom top spacing
      if (this.card.topSpacing && !this.card.noTopSpacing) {
        styles.marginTop = this.card.topSpacing;
      }

      // Handle text alignment
      if (this.card.align) {
        styles.textAlign = this.card.align;
      }

      return styles;
    },
    cardClasses() {
      const classes = [];

      if (this.card.noTopSpacing) {
        classes.push('no-top-spacing');
      }

      if (this.card.classes) {
        classes.push(this.card.classes);
      }

      return classes.join(' ');
    },
  },
};
</script>

<style scoped>
.nova-text-card {
  background: var(--white);
  border-radius: 0.5rem;
  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.05);
  padding: 1rem 1.5rem;
  margin-bottom: 0.75rem;
}

/* Responsive spacing control for mobile */
.nova-text-card.no-top-spacing {
  margin-top: -0.75rem;
}

/* Desktop spacing - full negative margin */
@media (min-width: 768px) {
  .nova-text-card.no-top-spacing {
    margin-top: -1.5rem;
  }
}

.text-card-content {
  font-size: 0.875rem;
  color: var(--60);
  line-height: 1.5;
}

/* HTML content styling */
.text-card-content :deep(h1),
.text-card-content :deep(h2),
.text-card-content :deep(h3),
.text-card-content :deep(h4),
.text-card-content :deep(h5),
.text-card-content :deep(h6) {
  margin-top: 0;
  margin-bottom: 0.5rem;
  color: var(--80);
  font-weight: 600;
}

.text-card-content :deep(p) {
  margin: 0;
  margin-bottom: 0.5rem;
}

.text-card-content :deep(p:last-child) {
  margin-bottom: 0;
}

.text-card-content :deep(a) {
  color: var(--primary);
  text-decoration: none;
  transition: color 0.15s ease-in-out;
}

.text-card-content :deep(a:hover) {
  color: var(--primary-dark);
  text-decoration: underline;
}

.text-card-content :deep(ul),
.text-card-content :deep(ol) {
  margin: 0;
  padding-left: 1.5rem;
}

.text-card-content :deep(li) {
  margin-bottom: 0.25rem;
}

.text-card-content :deep(strong),
.text-card-content :deep(b) {
  font-weight: 600;
  color: var(--80);
}

.text-card-content :deep(code) {
  background: var(--20);
  padding: 0.125rem 0.25rem;
  border-radius: 0.25rem;
  font-size: 0.8125rem;
  font-family: monospace;
}

/* List item styling */
.list-item {
  color: var(--60);
}

.list-separator {
  color: var(--40);
  margin: 0 0.125rem;
}

/* Dark mode support */
.dark .nova-text-card {
  background: var(--gray-800);
}

.dark .text-card-content {
  color: var(--gray-400);
}

.dark .text-card-content :deep(h1),
.dark .text-card-content :deep(h2),
.dark .text-card-content :deep(h3),
.dark .text-card-content :deep(h4),
.dark .text-card-content :deep(h5),
.dark .text-card-content :deep(h6),
.dark .text-card-content :deep(strong),
.dark .text-card-content :deep(b) {
  color: var(--gray-200);
}

.dark .text-card-content :deep(a) {
  color: var(--primary-50);
}

.dark .text-card-content :deep(a:hover) {
  color: var(--primary-40);
}

.dark .text-card-content :deep(code) {
  background: var(--gray-700);
  color: var(--gray-300);
}

.dark .list-item {
  color: var(--gray-400);
}

.dark .list-separator {
  color: var(--gray-600);
}
</style>
