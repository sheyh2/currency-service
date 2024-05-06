FROM nginx:stable-alpine

ARG UID
ARG GID

ENV UID=${UID}
ENV GID=${GID}

# MacOS staff group's gid is 20
RUN delgroup dialout

RUN addgroup -g ${GID} --system currenct
RUN adduser -G currenct --system -D -s /bin/sh -u ${UID} currenct

RUN mkdir -p /var/www
