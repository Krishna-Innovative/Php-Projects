
# iCE Angel ID - Web

Mobile-friendly Angular based web app for the iCE Angel ID Platform

## Project Setup

Requires ```node 0.10.33+```

1. Setup ```app/config.js``` based on ```app/config.dist.js```
2. In the command shell:
```
bower install
npm install --save
gulp serve
```

## Testing

### Unit Tests

Provided by karma.js

### Integration Tests

1. Setup API project in your local environment
2. Modify ```app/config.js```
3. Run tests

## Deploying

Via [flightplan.js](https://github.com/pstadler/flightplan)

Requires ssh access to the target server

1. Edit flightplan.js with target and deploy task, if needed
2. From the project folder, e.g.:

```
	node_modules/flightplan/bin/fly.js deploy:staging
```

## Troubleshooting & Useful Tools

_Examples of common tasks_

copy font-awesome to app/fonts

```
	gulp fonts
```