<?php
/**
 * Plugin Name: Austin Alpine Menu Dropdowns
 * Description: Restores submenu rendering for the custom theme header menu.
 */

if (!function_exists('alpine_primary_menu_tree')) {
    function alpine_primary_menu_tree() {
        $items = wp_get_nav_menu_items('Primary Menu');

        if (empty($items) || !is_array($items)) {
            return array();
        }

        $normalized = array();

        foreach ($items as $item) {
            $normalized[] = array(
                'id' => (int) $item->ID,
                'parent' => (int) $item->menu_item_parent,
                'title' => $item->title,
                'url' => $item->url,
                'classes' => is_array($item->classes) ? array_values(array_filter($item->classes)) : array(),
            );
        }

        return $normalized;
    }
}

add_action('wp_head', function () {
    ?>
<style>
  .main-nav .navbar-nav {
    align-items: center;
  }

  .main-nav .nav-item {
    position: relative;
  }

  .main-nav .nav-link {
    display: flex;
    align-items: center;
    gap: 0.35rem;
  }

  .main-nav .nav-link-wrap {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
  }

  .main-nav .sub-menu {
    list-style: none;
    margin: 0;
    padding: 0.75rem 0;
    min-width: 240px;
    position: absolute;
    top: 100%;
    left: 0;
    display: none;
    background: #173765;
    border-radius: 14px;
    box-shadow: 0 18px 40px rgba(5, 16, 37, 0.28);
    z-index: 1000;
  }

  .main-nav .sub-menu .sub-menu {
    top: -0.65rem;
    left: calc(100% + 0.3rem);
    min-width: 230px;
    background: #1c437a;
    border: 1px solid rgba(255, 255, 255, 0.08);
    box-shadow: 0 20px 42px rgba(5, 16, 37, 0.32);
  }

  .main-nav .sub-menu .nav-item {
    width: 100%;
  }

  .main-nav .sub-menu .nav-link {
    display: block;
    padding: 0.65rem 1rem;
    white-space: nowrap;
    font-size: 0.95rem;
  }

  .main-nav .sub-menu > .menu-item-has-children > .nav-link-wrap > .nav-link,
  .main-nav .sub-menu > .menu-item-has-children > .nav-link-wrap > .submenu-toggle {
    color: #ffffff;
  }

  .main-nav .sub-menu .sub-menu .nav-link {
    padding: 0.7rem 1rem;
    white-space: normal;
    line-height: 1.45;
  }

  .main-nav .sub-menu .nav-item:hover > .nav-link-wrap > .nav-link,
  .main-nav .sub-menu .nav-item:focus-within > .nav-link-wrap > .nav-link,
  .main-nav .sub-menu .nav-item:hover > .nav-link,
  .main-nav .sub-menu .nav-item:focus-within > .nav-link {
    background: rgba(255, 255, 255, 0.08);
  }

  .main-nav .sub-menu .menu-item-has-children > .nav-link-wrap {
    width: 100%;
    justify-content: space-between;
  }

  .main-nav .sub-menu .menu-item-has-children > .nav-link-wrap > .nav-link {
    flex: 1 1 auto;
  }

  .main-nav .sub-menu .menu-item-has-children > .nav-link-wrap > .nav-link .submenu-caret {
    transform: rotate(-45deg) translateY(-1px);
  }

  .main-nav .menu-item-has-children:hover > .sub-menu,
  .main-nav .menu-item-has-children:focus-within > .sub-menu {
    display: block;
  }

  .main-nav .submenu-caret {
    display: inline-block;
    width: 0.45rem;
    height: 0.45rem;
    border-right: 2px solid currentColor;
    border-bottom: 2px solid currentColor;
    transform: rotate(45deg) translateY(-1px);
  }

  .main-nav .submenu-toggle {
    display: none;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    padding: 0;
    border: 0;
    background: transparent;
    color: inherit;
    cursor: pointer;
    flex-shrink: 0;
    appearance: none;
    -webkit-appearance: none;
    line-height: 1;
  }

  .main-nav .submenu-toggle .submenu-caret {
    display: inline-block;
    transition: transform 0.2s ease;
  }

  @media (max-width: 991.98px) {
    .main-nav .navbar-nav {
      align-items: flex-start;
      width: 100%;
    }

    .main-nav .nav-item {
      width: 100%;
    }

    .main-nav .nav-link {
      width: 100%;
    }

    .main-nav .nav-link-wrap {
      display: flex;
      justify-content: space-between;
      width: 100%;
    }

    .main-nav .nav-link-wrap > .nav-link .submenu-caret {
      display: none;
    }

    .main-nav .submenu-toggle {
      display: inline-flex !important;
      color: #ffffff;
      opacity: 1;
      visibility: visible;
    }

    .main-nav .submenu-toggle .submenu-caret {
      display: inline-block !important;
      border-right-color: currentColor;
      border-bottom-color: currentColor;
    }

    .main-nav .sub-menu {
      position: static;
      display: none;
      min-width: 0;
      margin: 0.35rem 0 0.75rem 0;
      padding: 0.35rem 0 0.35rem 0.9rem;
      background: transparent;
      border-radius: 0;
      box-shadow: none;
    }

    .main-nav .sub-menu .sub-menu {
      top: auto;
      left: auto;
      min-width: 0;
      margin: 0.35rem 0 0.35rem 0.85rem;
      padding-left: 0.85rem;
      background: transparent;
      border: 0;
      box-shadow: none;
    }

    .main-nav .menu-item-has-children:hover > .sub-menu,
    .main-nav .menu-item-has-children:focus-within > .sub-menu {
      display: none;
    }

    .main-nav .menu-item-has-children.is-open > .sub-menu {
      display: block;
    }

    .main-nav .menu-item-has-children.is-open > .nav-link-wrap .submenu-toggle .submenu-caret {
      transform: rotate(-135deg) translateY(-1px);
    }

    .main-nav .sub-menu .nav-link {
      padding: 0.45rem 0;
      white-space: normal;
      font-size: 0.95rem;
    }
  }
</style>
    <?php
}, 100);

add_action('wp_footer', function () {
    if (is_admin()) {
        return;
    }

    $menu_items = alpine_primary_menu_tree();

    if (empty($menu_items)) {
        return;
    }
    ?>
<script>
  (function () {
    const menuData = <?php echo wp_json_encode($menu_items); ?>;
    const rootList = document.querySelector('.main-nav #mainMenu > ul.navbar-nav');

    if (!rootList || !Array.isArray(menuData) || !menuData.length) {
      return;
    }

    const byParent = new Map();

    menuData.forEach((item) => {
      const key = Number(item.parent || 0);
      if (!byParent.has(key)) {
        byParent.set(key, []);
      }
      byParent.get(key).push(item);
    });

    function closeBranch(branch) {
      if (!branch) {
        return;
      }

      branch.classList.remove('is-open');

      const branchToggle = branch.querySelector(':scope > .nav-link-wrap > .submenu-toggle');
      if (branchToggle) {
        branchToggle.setAttribute('aria-expanded', 'false');
      }

      branch.querySelectorAll('.menu-item-has-children.is-open').forEach((childBranch) => {
        childBranch.classList.remove('is-open');

        const childToggle = childBranch.querySelector(':scope > .nav-link-wrap > .submenu-toggle');
        if (childToggle) {
          childToggle.setAttribute('aria-expanded', 'false');
        }
      });
    }

    function buildBranch(parentId, depth) {
      const items = byParent.get(parentId) || [];

      if (!items.length) {
        return null;
      }

      const list = document.createElement('ul');
      list.className = depth === 0 ? 'navbar-nav mx-auto mb-2 mb-lg-0' : 'sub-menu';

      items.forEach((item) => {
        const li = document.createElement('li');
        const childItems = byParent.get(Number(item.id)) || [];
        const classes = ['nav-item'].concat(item.classes || []);

        if (childItems.length) {
          classes.push('menu-item-has-children');
        }

        li.className = Array.from(new Set(classes.filter(Boolean))).join(' ');

        if (childItems.length) {
          const linkWrap = document.createElement('div');
          linkWrap.className = 'nav-link-wrap';

          const link = document.createElement('a');
          link.className = 'nav-link';
          link.href = item.url || '#';
          link.textContent = item.title || '';

          const linkCaret = document.createElement('span');
          linkCaret.className = 'submenu-caret';
          linkCaret.setAttribute('aria-hidden', 'true');
          link.appendChild(linkCaret);
          linkWrap.appendChild(link);

          const toggle = document.createElement('button');
          toggle.className = 'submenu-toggle';
          toggle.type = 'button';
          toggle.setAttribute('aria-expanded', 'false');
          toggle.setAttribute('aria-label', 'Toggle ' + (item.title || 'submenu') + ' submenu');

          const caret = document.createElement('span');
          caret.className = 'submenu-caret';
          caret.setAttribute('aria-hidden', 'true');
          toggle.appendChild(caret);
          linkWrap.appendChild(toggle);
          li.appendChild(linkWrap);

          const childList = buildBranch(Number(item.id), depth + 1);
          if (childList) {
            childList.id = 'submenu-' + item.id;
            toggle.setAttribute('aria-controls', childList.id);
            li.appendChild(childList);

            toggle.addEventListener('click', () => {
              const isOpen = !li.classList.contains('is-open');

              if (!isOpen) {
                closeBranch(li);
                return;
              }

              li.parentElement.querySelectorAll(':scope > .menu-item-has-children.is-open').forEach((sibling) => {
                if (sibling !== li) {
                  closeBranch(sibling);
                }
              });

              li.classList.add('is-open');
              toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });

            childList.querySelectorAll('a.nav-link').forEach((subLink) => {
              subLink.addEventListener('click', () => {
                if (window.innerWidth <= 991.98) {
                  closeBranch(li);
                }
              });
            });
          }
        } else {
          const link = document.createElement('a');
          link.className = 'nav-link';
          link.href = item.url || '#';
          link.textContent = item.title || '';
          li.appendChild(link);
        }

        list.appendChild(li);
      });

      return list;
    }

    const rebuilt = buildBranch(0, 0);

    if (rebuilt) {
      rootList.replaceWith(rebuilt);
    }
  }());
</script>
    <?php
}, 100);
