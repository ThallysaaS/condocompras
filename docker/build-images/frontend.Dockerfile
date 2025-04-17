# create a image to build node js and install wrangler cli as well
#FROM node:14.15.4-alpine3.12
FROM node:16.15.1-alpine

# install wrangler cli
RUN npm install -g wrangler

# cloudflare credentials
# ARG CF_APY_KEY
# ARG CF_EMAIL

WORKDIR /app
