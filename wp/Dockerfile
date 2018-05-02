FROM wordpress:latest

ENV user www-data
ENV WORD=/var/www/html

# set user right away for determinism
# RUN addgroup -g 1000 -S $user \
#   && adduser -u 1000 -S $user -G $user

# create directory for persistence and give our user ownership
RUN chown -R $user:$user $WORD 
  # && chown -R $user:$user $HOME/app

# WORKDIR $HOME/app
# USER $user
