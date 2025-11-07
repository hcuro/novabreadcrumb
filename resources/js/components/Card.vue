<template>
  <div class="nova-breadcrumb-card">
    <nav class="breadcrumb-nav" aria-label="Breadcrumb">
      <ol class="breadcrumb-list">
        <li
          v-for="(item, index) in card.items"
          :key="index"
          class="breadcrumb-item"
          :class="{ 'is-active': index === card.items.length - 1 }"
        >
          <template v-if="index === 0 && card.showHomeIcon">
            <svg
              v-if="!item.url"
              class="home-icon"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
              />
            </svg>
            <a
              v-else
              :href="item.url"
              class="breadcrumb-link"
            >
              <svg
                class="home-icon"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"
                />
              </svg>
            </a>
          </template>
          <template v-else>
            <a
              v-if="item.url && index !== card.items.length - 1"
              :href="item.url"
              class="breadcrumb-link"
            >
              {{ item.label }}
            </a>
            <span v-else class="breadcrumb-text">
              {{ item.label }}
            </span>
          </template>

          <span
            v-if="index < card.items.length - 1"
            class="breadcrumb-separator"
            aria-hidden="true"
          >
            {{ separator }}
          </span>
        </li>
      </ol>
    </nav>
  </div>
</template>

<script>
export default {
  props: ['card'],

  computed: {
    separator() {
      return this.card.separator || '/';
    },
  },
};
</script>

<style scoped>
.nova-breadcrumb-card {
  background: var(--white);
  border-radius: 0.5rem;
  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.05);
  padding: 1rem 1.5rem;
  margin-top: -1.5rem; /* Counteract Nova's gap-6 spacing */
  margin-bottom: 0.75rem; /* Add a smaller gap below breadcrumb */
}

.breadcrumb-nav {
  display: flex;
  align-items: center;
}

.breadcrumb-list {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: 0.5rem;
}

.breadcrumb-item {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  font-size: 0.875rem;
}

.breadcrumb-link {
  color: var(--primary);
  text-decoration: none;
  transition: color 0.15s ease-in-out;
  display: flex;
  align-items: center;
  gap: 0.25rem;
}

.breadcrumb-link:hover {
  color: var(--primary-dark);
  text-decoration: underline;
}

.breadcrumb-text {
  color: var(--60);
  font-weight: 500;
}

.breadcrumb-item.is-active .breadcrumb-text {
  color: var(--80);
  font-weight: 600;
}

.breadcrumb-separator {
  color: var(--40);
  user-select: none;
  font-weight: 300;
}

.home-icon {
  width: 1rem;
  height: 1rem;
  color: currentColor;
}

/* Dark mode support */
.dark .nova-breadcrumb-card {
  background: var(--gray-800);
}

.dark .breadcrumb-link {
  color: var(--primary-50);
}

.dark .breadcrumb-link:hover {
  color: var(--primary-40);
}

.dark .breadcrumb-text {
  color: var(--gray-400);
}

.dark .breadcrumb-item.is-active .breadcrumb-text {
  color: var(--gray-200);
}

.dark .breadcrumb-separator {
  color: var(--gray-600);
}
</style>
