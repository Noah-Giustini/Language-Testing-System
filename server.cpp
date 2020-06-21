#include <stdio.h>
#include <unistd.h>
#include <string.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <stdlib.h>
#include <signal.h>
#include <iostream>
#include <cstring>

//global constraints
#define MAX_BUFFER_SIZE 40
#define MAX_MESSAGE_LENGTH 100
#define MYPORTNUM 31337       //port this server is running on
#define SERVER_IP "127.0.0.1" //UDP server's ip

//debugging option. set to 1 to show debug info
#define DEBUG 1

/* Global variable */
int childsockfd;

using namespace std;

//function to handle exit cleanly
void catcher(int sig)
{
    close(childsockfd);
    exit(0);
}

//main server 
int main()
{
    struct sockaddr_in server;
    static struct sigaction act;
    char messagein[MAX_MESSAGE_LENGTH];         //char array to hold the incoming message from client
    char messageout[MAX_MESSAGE_LENGTH];
    char transformation[MAX_MESSAGE_LENGTH];    //char array to hold the client's desired transformation
    int server_ports[7];                        //int array to hold all of the sockets that will be used for transformations
    int parentsockfd;
    int i, j;
    int pid;
    char c;
    int server_port;                            //hold what port the server will operate on


    /* Set up a signal handler to catch some weird termination conditions. */
    act.sa_handler = catcher;
    sigfillset(&(act.sa_mask));
    sigaction(SIGPIPE, &act, NULL);

    //initalize the server sockaddr struct with indended values
    memset(&server, 0, sizeof(server));
    server.sin_family = AF_INET;
    server.sin_port = htons(MYPORTNUM);
    server.sin_addr.s_addr = htonl(INADDR_ANY);

    //setup socket for TCP transport
    if ((parentsockfd = socket(PF_INET, SOCK_STREAM, 0)) == -1)
    {
        fprintf(stderr, "server: socket() call failed!\n");
        exit(1);
    }

    //bind an address and port to the socket
    if (bind(parentsockfd, (struct sockaddr *)&server, sizeof(struct sockaddr_in)) == -1)
    {
        fprintf(stderr, "server: bind() call failed!\n");
        exit(1);
    }

    //listen for connections on that socket
    if (listen(parentsockfd, 5) == -1)
    {
        fprintf(stderr, "server: listen() call failed!\n");
        exit(1);
    }

    //ensure message in and message out are zero'd out to avoid ghosting
    bzero(messagein, MAX_MESSAGE_LENGTH);
    bzero(messageout, MAX_MESSAGE_LENGTH);

    fprintf(stderr, "Welcome! I am the Language Testing System server!!\n");
    fprintf(stderr, "server listening on TCP port %d...\n\n", MYPORTNUM);

    //loop forever waitingfor connections
    for (;;)
    {
        //accept a connection
        if ((childsockfd = accept(parentsockfd, NULL, NULL)) == -1)
        {
            fprintf(stderr, "server: accept() call failed!\n");
            exit(1);
        }

        //try to fork off so that a child process can deal with the new connection and parent can continue to search for new connections
        pid = fork();

        //if the fork failed handle it
        if (pid < 0)
        {
            fprintf(stderr, "server: fork() call failed!\n");
            exit(1);
        }
        else if (pid == 0)
        {
            //we are dealing with the child process in this case and we may close the parentsock since we are not searching for connections anymore on this process
            close(parentsockfd);

            //recieve the message in from the client
            while (recv(childsockfd, messagein, MAX_MESSAGE_LENGTH, 0) > 0)
            {
                string protocol;
                string val1;
                string val2;
                string val3;
                
                //for all the characters in the input
                for (int i = 0; i < strlen(messagein); i++)
                {   
                   char *vals[4];
                   int iCurName = 0;
                   char *token;

                    /* get the first token */
                    token = strtok(messagein, "\n");

                    /* walk through other tokens */
                    while( token != NULL ) 
                    {
                        vals[iCurName] = (char*) malloc(strlen(token) + 1);
                        strcpy(vals[iCurName],token);
                        iCurName ++;

                        token = strtok(NULL, "\n");
                    }
                    
                    protocol = vals[0];
                    val1 = vals[1];
                    val2 = vals[2];
                    val3 = vals[3];

                    char c1[val1.size()+1];
                    char c2[val2.size()+1];
                    char c3[val3.size()+1];
                        

                    strcpy(c1, val1.c_str());
                    strcpy(c2, val2.c_str());
                    strcpy(c3, val3.c_str());

                    if (protocol == "L"){
                        char loginCmd[1000];
                        sprintf(loginCmd, "php loginScript.php %s %s", c1, c2);


                        char buffer[128];
                        string result = "";
                        FILE* pipe = popen(loginCmd, "r");
                        if (!pipe) throw runtime_error("popen() failed!");
                        try {
                            while (fgets(buffer, sizeof buffer, pipe) != NULL) {
                                result += buffer;
                            }
                        } catch (...) {
                            pclose(pipe);
                            throw;
                        }
                        pclose(pipe);
                        
                        //login was good tell the client
                        if (result == "success"){
                            strcpy(messageout,"success(1)");
                            /* send the result message back to the client */
                            send(childsockfd, messageout, strlen(messageout), 0);
                        }
                        //login was not good tell the client
                        else{
                            strcpy(messageout,"error(0)");
                            /* send the result message back to the client */
                            send(childsockfd, messageout, strlen(messageout), 0);
                        }
                    }
                    else if (protocol == "G"){
                        string val3;

                        char gradeCmd[1000];
                        sprintf(gradeCmd, "php gradeScript.php %s %s %s", c1, c2, c3);


                        char buffer[128];
                        string result = "";
                        FILE* pipe = popen(gradeCmd, "r");
                        if (!pipe) throw runtime_error("popen() failed!");
                        try {
                            while (fgets(buffer, sizeof buffer, pipe) != NULL) {
                                result += buffer;
                            }
                        } catch (...) {
                            pclose(pipe);
                            throw;
                        }
                        pclose(pipe);
                        
                        //login was good tell the client
                        if (result == "success"){
                            strcpy(messageout,"success(1)");
                            /* send the result message back to the client */
                            send(childsockfd, messageout, strlen(messageout), 0);
                        }
                        //login was not good tell the client
                        else{
                            strcpy(messageout,"error(0)");
                            /* send the result message back to the client */
                            send(childsockfd, messageout, strlen(messageout), 0);
                        }
                    }

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    //now these valuse can be handeled between either login or grading and passed to a php script to interract with the db


                }
                
                

#ifdef DEBUG
                //insert print statements here
#endif
                /* clear out message strings again to be safe */
                bzero(messagein, MAX_MESSAGE_LENGTH);
            }

            /* when client is no longer sending information to us, */
            /* the socket can be closed and the child process terminated */
            close(childsockfd);
            exit(0);
        } /* end of then part for child */
        else
        {
            /* the parent process is the one doing the "else" part */
            fprintf(stderr, "Created child process %d to handle that client\n", pid);
            fprintf(stderr, "Parent going back to job of listening...\n\n");

            /* parent doesn't need the childsockfd */
            close(childsockfd);
        }
    }
}
