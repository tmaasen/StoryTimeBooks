<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <a href="http://127.0.0.1:8000/">
        <img src="../assets/StoryTime-1.png" width="200" class="navbar-brand" alt="Go to Home" />
      </a>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav-item-dropdown id="showSelect" text="Type" right>
            <div id="showList">
              <li>
                <b-dropdown-item href="#">Title</b-dropdown-item>
              </li>
              <li>
                <b-dropdown-item href="#">Author</b-dropdown-item>
              </li>
              <li>
                <b-dropdown-item href="#">Publisher</b-dropdown-item>
              </li>
              <li>
                <b-dropdown-item href="#">Year</b-dropdown-item>
              </li>
            </div>
          </b-nav-item-dropdown>
          <b-nav-form>
            <b-form-input size="md" class="mr-sm-2" placeholder="Search"></b-form-input>
            <b-button size="md" class="my-2 my-sm-0" type="submit">Search</b-button>
          </b-nav-form>

          <b-dropdown variant="primary">
            <template v-slot:button-content>
              <b-icon icon="person-fill" aria-hidden="true"></b-icon>My Account
            </template>
            <b-dropdown-item-button>
              <b-icon icon="blank" aria-hidden="true"></b-icon>Profile
              <span class="sr-only">(Not selected)</span>
            </b-dropdown-item-button>
            <b-dropdown-item-button>
              <b-icon icon="blank" aria-hidden="true"></b-icon>Logout
              <span class="sr-only">(Selected)</span>
            </b-dropdown-item-button>
            <b-dropdown-divider></b-dropdown-divider>
          </b-dropdown>
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>
  </div>
</template>

<style>
.bg-info {
  background-color: #373b40 !important;
}

.btn-group,
.btn-group-vertical {
  position: relative;
  display: -ms-inline-flexbox;
  display: inline-flex;
  vertical-align: middle;
  margin-left: 5px;
}

.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 9.5rem;
  padding: 0.5rem 0;
  margin: 0.125rem 0 0;
  font-size: 1rem;
  color: #212529;
  text-align: left;
  list-style: none;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.25rem;
}
</style>

<script>
$('#showList li').on('click', function() {
  $('#showSelect').val($(this).text());
});
</script>