# chinapower_wp

WordPress theme for [ChinaPower](https://chinapower.csis.org). Developed from the [\_s starter theme](http://underscores.me).

## Quick-start Instructions

### If setting up the project for the first time:

1. Follow the instructions in the "Install Local" and "Connect Local to WP Engine" sections in this [blog post](https://wpengine.com/support/local/).
2. Follow the instructions in the "pull to Local from WP Engine" section to pull the "ChinaPower Staging" Environment to your local machine
3. Navigate to the directory where Local created the site: eg `cd /Users/[YOUR NAME]/Local Sites/chinapower/app/public`
4. Initiate git & add remote origin. This will connect your local directory to the Git Repo and create a local `main` branch synced with the remote `main` branch.

```shell
$ git init
$ git remote add origin git@github.com:CSIS-iLab/chinapower_wp.git
$ git fetch origin
$ git checkout origin/main -ft
```

### If project is already set up:

To begin development, navigate to the theme directory and start npm.

```shell
$ cd wp-content/themes/chinapower_wp
$ npm install
$ npm start
```

### CI/CD

GitHub Actions will automatically build & deploy the theme to either the development or staging environment on WPE depending on the settings specified in the deployment workflow.

- The `WPE_ENVIRONMENT_NAME: ${{ secrets.WPENGINE_DEV_ENV_NAME }}` setting will be deployed to the WPE Development Environment. The Development environment should be used to demo new features to programs.

- The `WPE_ENVIRONMENT_NAME: ${{ secrets.WPENGINE_STAGING_ENV_NAME }}` setting will be deployed to the WPE Staging Environment. **Note:** The program actively uses their staging site, so it is recommended that you coordinate with the program before pushing changes to this environment.

### See More Commands

This will display all available commands, such as running eslint or imagemin independently.

```shell
$ npm run
```

## Contributing

### Branching

When modifying the code base, always make a new branch. Unless it's necessary to do otherwise, all branches should be created off of `main`.

Branches should use the following naming conventions:

| Branch type               | Name                                                      | Example                     |
| ------------------------- | --------------------------------------------------------- | --------------------------- |
| New Feature               | `feature/<short description of feature>`                  | `feature/header-navigation` |
| Bug Fixes                 | `bug/<short description of bug>`                          | `bug/mobile-navigation`     |
| Documentation             | `docs/<short description of documentation being updated>` | `docs/readme`               |
| Code clean-up/refactoring | `refactor/<short description>`                            | `refactor/apply-linting`    |
| Content Updates           | `content/<short description of content>`                  | `content/add-new-posts`     |

### Commit Messages

Write clear and concise commit messages describing the changes you are making and why. If there are any issues associated with the commit, include the issue # in the commit title.
