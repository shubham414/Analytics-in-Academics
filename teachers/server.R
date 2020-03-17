
shinyServer(function(input, output) {
  value<-reactiveValues(click=FALSE)
  pievalue<-reactiveValues(click=FALSE)
  Data <- reactive({
    
    
    # input$file1 will be NULL initially. After the user selects and uploads a 
    # file, it will be a data frame with 'name', 'size', 'type', and 'datapath' 
    # columns. The 'datapath' column will contain the local filenames where the 
    # data can be found.
    inFile <- input$file1
    
    if (is.null(inFile))
      return(NULL)
    
    df.raw <- read.csv(inFile$datapath, header=TRUE, sep=',', quote='"')
    #mydata<-read.csv(inFile$datapath, header=input$header, sep=input$sep, quote=input$quote)
    # calculate term and pupil averages
    number<-ncol(df.raw)
    tot<-nrow(df.raw)
    subj<-array(1:number,dim=c(number))
    # zz<-array(1:number,dim=c(number))
    zz<-0
    if((colnames(df.raw[number])=="Class") | (colnames(df.raw[number-1])=="Class")| (colnames(df.raw[number-2])=="Class") |(colnames(df.raw[number])=="CLASS") | (colnames(df.raw[number-1])=="CLASS")| (colnames(df.raw[number-2])=="CLASS"))
    {
      number<-number-3
    }
    else
    {
      number<-number-2
    }
    for(i in 3:number)
    {
      subj[i]<-colnames(df.raw)[i]
    }
    
    name<-colnames(df.raw[3:number])
    subavg<-array(1:number,dim=c(number-2))
    hh<-array(1:15,dim=c(15))
    for(i in 1:number-2)
    {
      subavg[i]<-colMeans(df.raw[3:number])[i]
      
    }
    
    colMax <- function(df.raw) sapply(df.raw, max, na.rm = TRUE)
    abcde<-colMax(df.raw[3:number])[2]
    for(i in 1:number-2)
    {
      hh[i]<-colMax(df.raw[3:number])[i]
    }
    #  df.raw$Av <- round(rowMeans(df.raw[3:12]),1)
    
    # reshape th data.frame for further analysis
    df.melt <- melt(df.raw, id.vars=c("Roll","Name"))
    colnames(df.melt) <- c("Roll","Name","Subject","Mark")
    
    filename<-basename(inFile$name)
    filename<-substr(filename,1,nchar(filename)-4)
    
    # create a list of data for use in rendering
    info <- list(df.raw=df.raw,df.melt=df.melt,name=name,subj=subj,number=number,subavg=subavg,tot=tot,zz=zz,hh=hh,filename=filename,abcde=abcde)
    return(info)
  })
  
  
  
  # allows pageability and number of rows setting
  myOptions <- reactive({  
    list(
      #page=ifelse(input$pageable==TRUE,'enable','disable'),
      pageSize=input$pagesize
      
    ) 
  } )
  
  output$dropoptions<- renderUI({
    selectInput("select",label=h3("Plot for"),
                choices = Data()$name,
                selected=Data()$subj[3]
    )
  })
  

  # observe({
  #   if (is.null(input$save))
  #     return()
  #   value$click = FALSE
  # })
  
  output$raw <- renderGvis({
    
    
    if (is.null(input$file1)) { return() }
    file<-Data()$filename
    con<-dbConnect(MySQL(),user='root',password='',dbname='analysis',host='localhost')
    
    if(dbExistsTable(con,"name"))
    {
      sql1<-dbSendQuery(con,"drop table name")   
      sql2<-dbSendQuery(con,"create table name(Name varchar(255))")
      sql3<-paste("insert into name(Name) values('",file,"')",sep="")
      sql4<-dbSendQuery(con,sql3)
    }
    if(dbExistsTable(con,"test"))
      sql<-dbSendQuery(con,"drop table test")
    dbWriteTable(con,"test",Data()$df.raw,append="TRUE")
    
  
    dbDisconnect(con)
    
    if(is.null(Data()$number)){return()}
    else  if(input$filter=='a'){
      gvisTable(Data()$df.raw,options=myOptions())
    }
    else if(input$filter=='d'){
      df.temp <- subset(Data()$df.raw,Percentage>=66)
      gvisTable(df.temp,options=myOptions())
    }
    else if(input$filter=='f'){
      df.temp <- subset(Data()$df.raw,Percentage>=60 & Percentage<66 )
      gvisTable(df.temp,options=myOptions())
    }
    else if(input$filter=='h'){
      df.temp <- subset(Data()$df.raw,Percentage>=55 & Percentage<60)
      gvisTable(df.temp,options=myOptions())
    }
    else if(input$filter=='s'){
      df.temp <- subset(Data()$df.raw,Percentage>=50 & Percentage<55)
      gvisTable(df.temp,options=myOptions())
    }
    else if(input$filter=='p'){
      df.temp <- subset(Data()$df.raw,Percentage>=40 & Percentage<50)
      gvisTable(df.temp,options=myOptions())
    }
    else if(input$filter=='fail'){
      df.temp <- subset(Data()$df.raw,Percentage<40)
      gvisTable(df.temp,options=myOptions())
    }
  })
  
  output$reportall<-renderPlot({
    if (is.null(input$file1)) { return() }
    else
    {
      
      df.graph2 <- subset(Data()$df.melt,Subject!="Total" & Subject!="Percentage" & Subject!= "Av" & Subject!= "Grand.Total" &Subject!= "Class")
      df.graph3 <- subset(Data()$df.melt,Subject=="Total" | Subject=="Grand.Total")
      df.graph2[4] <- sapply(df.graph2[4],as.numeric)
      df.graph3[4] <- sapply(df.graph3[4],as.numeric)
      if(input$rr=="g")
        print(ggplot(df.graph3, aes(x=Mark, fill=Subject)) + geom_density(alpha=.8)+ scale_fill_manual( values = c("black"))+theme_bw())
      else
        print(ggplot(df.graph3, aes(x=Mark, fill=Subject)) + geom_histogram(alpha=.8)+ scale_fill_manual( values = c("firebrick1"))+theme_bw())
      
      #   for(i in 1:number-2)
      #  {
      #   subavg[i]<-colMeans(df.raw[3:number])[i]
      
      #}
      
      
      p = ggplot(data=df.graph3, 
                 aes(x=factor(1),
                     y=Percentage,
                     fill = factor(response)
                 ),
                 print(p=p + geom_bar(width = 1) )
      ) 
    }
    
  })
  
  output$textall <- renderText( {
    if (is.null(input$file1)) { return() }
    
    "Report For Semester"
  })
  output$density <- renderPlotly({
    if (is.null(input$file1)) { return() }
    # df.graph <- subset(Data()$df.melt,Subject!="Total" & Subject!="Percentage" & Subject!= "Av")
    else if(is.null(Data()$number) | is.null(input$select)){return()}
    else
    {
      for(i in 3:Data()$number)
      {
        if(input$select==Data()$subj[i])
        {
          df.graph <- subset(Data()$df.melt,Subject==Data()$subj[i])
          break
        }
      }
    }
    df.graph[4] <- sapply(df.graph[4],as.numeric)
    str(df.graph)
    if(input$ss=='g'){
      p<-ggplot(df.graph, aes(x=Mark, fill=Subject)) + geom_density(alpha=1) + scale_fill_manual( values = c("orchid"))+theme_bw()
      print(ggplotly(p))
    }
    else{
      p<-ggplot(df.graph, aes(x=Mark, fill=Subject)) + geom_histogram(alpha=1) + scale_fill_manual( values = c("orange"))+theme_bw()
      print(ggplotly(p))
      # print(hist(Data()$df.raw$t1Av))
    }
  })
  
  
  output$performance <- renderPlotly({
    if (is.null(input$file1)) { return() }
    if(input$ch=='r')
      df.graph <- subset(Data()$df.melt,Roll==input$c & Subject!="Percentage" & Subject!="Av" & Subject!="Total" & Subject!="Grand.Total" & Subject!="Class")
    else
      df.graph <- subset(Data()$df.melt,Name==toupper(input$c) & Subject!="Percentage" & Subject!="Av" & Subject!="Total" & Subject!="Grand.Total"  & Subject!="Class")
    
    df.graph[4] <- sapply(df.graph[4],as.numeric)
    
    p<-ggplot(df.graph, aes(x=Subject,y=Mark)) +
        #  scale_fill_gradient("Count", low = "cornflowerblue", high = "blue")+
            geom_bar(aes(fill=Mark),stat="identity",width = 0.5)+theme_bw()
    print(ggplotly(p))
  })
  
  output$report <- renderPrint({
    if (is.null(input$file1)) { return() }
    
    #df.gender<- subset(Data()$df.melt,Subject!="Av")
    # aov.by.gender <- aov(Mark ~ Gender, data=df.gender)
    #summary(aov.by.gender) 
  })
  
  output$markdown <- renderUI({
    HTML(markdown::markdownToHTML(knit('rep.Rmd', quiet = TRUE)))
    #a("test", href="http://google.com", target="_blank") 
  })
  
  output$performancetable<-renderGvis(
    {
      if (is.null(input$file1)) { return() }
      else
      {
        if(input$ch=='r')
          df.temp <- subset(Data()$df.raw,Roll==input$c)
        else
          df.temp <- subset(Data()$df.raw,Name==toupper(input$c))
        gvisTable(df.temp,options=myOptions()) 
      }
    }
  )
  
  
  #output$myTable1 <- renderTable({ 
  #   data.frame(Sr.No. =(length.out=5), ExamNo.=(""), Student="" ,Marks="",Percentage="")
  # }, include.rownames = FALSE)
  # output$myTable2 <- renderTable({ 
  #   data.frame(No.ofStudents=(length.out=5), Pass=(""), failwithATKT= "" ,fail="",PassPercentage="")
  #  }, include.rownames = FALSE)
  # output$myTable3 <- renderTable({ 
  #   data.frame(No.ofStudentsAppearedPercentage=(length.out=5), DISTINCTIONonwards="", FirstClass="" ,HigherSecondClass="",SecondClass="",PassClass="")
  #  }, include.rownames = FALSE) 
  #  output$myTable4 <- renderTable({ 
  #    data.frame(Subject=(length.out=5), Appeared=(""), pass="" ,fail="",percentage="")
  #  }, include.rownames = FALSE)
  
  output$caption1 <- renderText( {
    if (is.null(input$file1)) { return() }
    
    "Student Marks"
  })
  
  output$caption2 <- renderText( {
    if (is.null(input$file1)) { return() }
    # paste0("Average Mark  DS : ", Data()$t1Av," CO : ", Data()$t2Av," DELD :", Data()$t3Av)
    else if(is.null(Data()$number)|is.null(input$select)){return()}
    else
    {
      for(i in 3:Data()$number)
      {
        if(input$select==Data()$subj[i])
        {
          store<-i
          break
        }
      }
      paste0("Average Marks : ", Data()$subavg[i-2])
    }
  })
  
  
  # output$caption3 <- renderText( {
  #  if (is.null(input$file1)) { return() }
  #   paste0("Analysis of Variance by Gender - Boys Average Mark:",Data()$boys, "  Girls Average Mark:",Data()$girls)
  # })
  
  output$notes2 <- renderUI( {
    if (is.null(input$file1)) { return() }
    HTML("The above graph shows the variation in pupils' marks by term. The annual spread
         will normally be greater as the example data is random and normally some pupils will
         tend to be better than others over each term")
    paste0("The marks for subject ", input$select,":")
    
    # paste0("tempmax is",Data()$abcde)
  })
  
  output$notes3 <- renderUI( {
    if (is.null(input$file1)) { return() }
    HTML("The Analysis of Variance indicates whether there is a statistically significant
         difference between boys and girls in the class. With this 'fixed' data, there is a
         significant difference at the 5% level")
    
  })
  
  output$caption4 <- renderText( {
    if (is.null(input$file1)) { return() }
    if(is.null(input$c)){return()}
    else 
    {
      df.rollno <- subset(Data()$df.melt,Roll==input$c & Subject!="Percentage" & Subject!="Av" & Subject!="Total" & Name!="Name" & Roll!= "Roll")
      
      paste0(df.rollno[1,3][],":",df.rollno[1,4][],"  ",df.rollno[2,3][],":",df.rollno[2,4][],"  ",df.rollno[3,3][],":",df.rollno[3,4][],"  ",df.rollno[4,3][],":",df.rollno[4,4][],"  ",df.rollno[5,3][],":",df.rollno[5,4][],"  ",df.rollno[6,3][],":",df.rollno[6,4][],"  ",df.rollno[7,3][],":",df.rollno[7,4][],"  ",df.rollno[8,3][],":",df.rollno[8,4][],"  ",df.rollno[9,3][],":",df.rollno[9,4][],"  ",df.rollno[10,3][],":",df.rollno[10,4][])
      
      
    }
  })
  output$newtable<-renderGvis({
    if (is.null(input$file1)) { return() }
    else if(is.null(input$select)){return()}
    else
      
      
      if(input$filter2=='a')
      {
        df.sel<-subset(Data()$df.melt,Subject==input$select)
      }
    else if(input$filter2=='d')
    {
      for(i in 3:Data()$number){
        if(input$select==Data()$subj[i])
        {
          if(Data()$hh[i-2]>50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=66)
          else if(Data()$hh[i-2]>=25 & Data()$hh[i-2]<50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=0.66*50)
          else
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=0.66*25)
        } 
      }
    }
    else if(input$filter2=='f')
    {
      for(i in 3:Data()$number)
        if(input$select==Data()$subj[i])
          if(Data()$hh[i-2]>50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=60 & Mark<=66)
          else if(Data()$hh[i-2]>=25 & Data()$hh[i-2]<50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=50*0.60 & Mark<=50*0.66)
          else
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=0.60*25 & Mark<=25*0.66)
          
    }
    else if(input$filter2=='h')
    {
      for(i in 3:Data()$number)
        if(input$select==Data()$subj[i])
          if(Data()$hh[i-2]>50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=55 & Mark<=60)
          else if(Data()$hh[i-2]>=25 & Data()$hh[i-2]<50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=50*0.55 & Mark<=50*0.60)
          else
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=0.55*25 & Mark<=25*0.60)
    }
    else if(input$filter2=='s')
    {
      for(i in 3:Data()$number)
        if(input$select==Data()$subj[i])
          if(Data()$hh[i-2]>50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=50 & Mark<=55)
          else if(Data()$hh[i-2]>=25 & Data()$hh[i-2]<50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=50*0.50 & Mark<=50*0.55)
          else
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=0.50*25 & Mark<=25*0.55)
    }
    else if(input$filter2=='p')
    {
      for(i in 3:Data()$number)
        if(input$select==Data()$subj[i])
          if(Data()$hh[i-2]>50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=40 & Mark<=50)
          else if(Data()$hh[i-2]>=25 & Data()$hh[i-2]<50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=50*0.40 & Mark<=50*0.50)
          else
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=0.40*25 & Mark<=25*0.50)
    }
    else if(input$filter2=='fail')
    {
      #if(Data()$subavg[input$select]>=40)
      for(i in 3:Data()$number)
      {
        if(input$select==Data()$subj[i])
        {
          if(Data()$hh[i-2]>50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark<40)
          else if(Data()$hh[i-2]>=25 & Data()$hh[i-2]<50)
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark<20)
          else
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark<10)
        }
      }
      
      
    }
    gvisTable(df.sel,options=list(width="920px",height="400px"))
    
  })
  
  output$chart<-renderPlotly(
    
    {
      
      # if(input$filter2=='d')
      
      for(i in 3:Data()$number)
        
        
        if(input$select==Data()$subj[i])
          if(Data()$hh[i-2]>50)
          {
            df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=66)
            df.sel2<-subset(Data()$df.melt,Subject==input$select & Mark>=60 & Mark<=66)
            df.sel3<-subset(Data()$df.melt,Subject==input$select & Mark>=55 & Mark<=60)
            df.sel4<-subset(Data()$df.melt,Subject==input$select & Mark>=50 & Mark<=55)
            df.sel5<-subset(Data()$df.melt,Subject==input$select & Mark<40)
            
          }
      else  if(Data()$hh[i-2]>25 & Data()$hh[i-2]<=50)
      {
        df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=0.66*50)
        df.sel2<-subset(Data()$df.melt,Subject==input$select & Mark>=50*0.60 & Mark<=50*0.66)
        df.sel3<-subset(Data()$df.melt,Subject==input$select & Mark>=50*0.55 & Mark<=50*0.60)
        df.sel4<-subset(Data()$df.melt,Subject==input$select & Mark>=50*0.50 & Mark<=50*0.55)
        df.sel5<-subset(Data()$df.melt,Subject==input$select & Mark<50*0.40)
      }
      else if(Data()$hh[i-2]<=25)
      {
        df.sel<-subset(Data()$df.melt,Subject==input$select & Mark>=0.66*25)
        df.sel2<-subset(Data()$df.melt,Subject==input$select & Mark>=25*0.60 & Mark<=25*0.66)
        df.sel3<-subset(Data()$df.melt,Subject==input$select & Mark>=25*0.55 & Mark<=25*0.60)
        df.sel4<-subset(Data()$df.melt,Subject==input$select & Mark>=25*0.50 & Mark<=25*0.55)
        df.sel5<-subset(Data()$df.melt,Subject==input$select & Mark<25*0.40)
      }
      counttemp<-1
      # number<-ncol(df.raw)
      
      for(i in 3:Data()$number)
        
      {
        if(input$select==Data()$subj[i])
          tempdata<-df.sel[5,4]
        # if(Data()$tempdata>40)
        break
        counttemp<-tempdata
        
      }
      
      
      cc<-nrow(df.sel)
      cc2<-nrow(df.sel2)
      cc3<-nrow(df.sel3)
      cc4<-nrow(df.sel4)
      cc5<-nrow(df.sel5)
      
      
      # df.sel<-rbind(df.sel,newRow) 
      #  variable<-c("Distinction", "First Class","Higher Second Class"," Second Class","Fail")
      x<-c(cc,cc2,cc3,cc4,cc5)
      count<-c(paste("Distinction"),paste("First Class"),paste("Higher Second Class"),paste("Second Class"),paste("Fail"))
      cols<-c("brown2","cadetblue3","hotpink2","chartreuse3","peru")   
     # pie(x, labels = count, main = "Distribution of Students According to Class",col=cols,init.angle =90,radius = 1)
      p <- plot_ly(as.data.frame(x), labels = count, values = x, type = 'pie',textposition = 'inside',
                   textinfo = 'label+percent', showlegend = FALSE) %>%
        layout(title = 'Distribution of Students according to Class',
               xaxis = list(showgrid = FALSE, zeroline = FALSE, showticklabels = FALSE),
               yaxis = list(showgrid = FALSE, zeroline = FALSE, showticklabels = FALSE))
      
      
      
    }
  )
  
  output$allchart<-renderPlotly(
    
    {
      
      
      
      # for(i in 3:Data()$number)
      #if(input$select==Data()$subj[i])
      #if(Data()$subavg[i-2]>=40)
      {
        df.sel<-subset(Data()$df.melt,Subject=="Percentage" & Mark>=66)
        df.sel2<-subset(Data()$df.melt,Subject=="Percentage" & Mark>=60 & Mark<=66)
        df.sel3<-subset(Data()$df.melt,Subject=="Percentage" & Mark>=55 & Mark<=60)
        df.sel4<-subset(Data()$df.melt,Subject=="Percentage" & Mark>=50 & Mark<=55)
        df.sel5<-subset(Data()$df.melt,Subject=="Percentage" & Mark>=40 & Mark<=50)
        df.sel6<-subset(Data()$df.melt,Subject=="Percentage" & Mark<40)
        
      }
      
      counttemp<-1
      cc<-nrow(df.sel)
      cc2<-nrow(df.sel2)
      cc3<-nrow(df.sel3)
      cc4<-nrow(df.sel4)
      cc5<-nrow(df.sel5)
      cc6<-nrow(df.sel6)
      zz<-cc
      #  zz[1]<-nrow(df.sel)
      
      
      #df11 <- data.frame(
      # variable = c("Distinction", "First Class","Higher Second Class"," Second Class","Pass Class","Fail"),
      # percent=c(cc/Data()$tot*100,cc2/Data()$tot*100,cc3/Data()$tot*100,cc4/Data()$tot*100,cc5/Data()$tot*100,cc6/Data()$tot*100)
      
      # )
      
      #variable<-c("Distinction", "First Class","Higher Second Class"," Second Class","Pass Class","Fail")
      x<-c(cc,cc2,cc3,cc4,cc5,cc6)
      count<-c(paste("Distinction"),paste("First Class"),paste("Higher Second Class"),paste("Second Class"),paste("Pass Class"),paste("Fail"))
      # print(ggplot(df11, aes(x = "tttt", y = percent, fill = variable,label=variable)) +
      #      geom_bar(width = 1, stat = "identity") +
      #scale_fill_manual(values = c("red", "yellow")) +
      #       coord_polar("y", start = pi / 3) )
      #labs(title = ""))
      cols<-c("brown2","cadetblue3","hotpink2","chartreuse3","darkseagreen4","peru")   
      #pie(x, labels = count, main = "Distribution of Students According to Class",col=cols,init.angle =90,radius = 1)
      p <- plot_ly(as.data.frame(x), labels = count, values = x, type = 'pie',textposition = 'inside',
                   textinfo = 'label+percent', showlegend = FALSE) %>%
        layout(title = 'Distribution of Students according to Class',
               xaxis = list(showgrid = FALSE, zeroline = FALSE, showticklabels = FALSE),
               yaxis = list(showgrid = FALSE, zeroline = FALSE, showticklabels = FALSE))
      
    }
  )
  
  output$repend <- renderText( {
    if (is.null(input$file1)) { return() }
    
    
    #paste0("Distinction")
    
    #,"First Class",cc2,"Higher Second Class",cc3," Second Class",cc4,"Pass Class",cc5,"Fail",cc6)
  })
  

  
  
  count_dist<<-0
  count_first<<-0
  count_hsecond<<-0
  count_second<<-0
  count_pass<<-0
  count_atkt<<-0
  count_fail<<-0
  
  
  output$predict<-renderGvis({

    con<-dbConnect(MySQL(),user='root',password='',dbname='analysis',host='localhost')
    
    
      #dataset <- read.csv("D:/analytics/santosh/training.csv")
      dataset<-dbReadTable(con,"training")
      dbDisconnect(con)
      temp_train <- subset(dataset, select = c("Percentage","Class"))
      trainset <- temp_train[1:200, ]
    
    
      #  print(net.sqrt)
      
      #Plot the neural network
      # plot(net.sqrt)
     
      #Test the neural network on some training data
      #testdata <- as.data.frame((1:10)^2) #Generate some squared numbers
      flag<<-0
      while(flag==0)
      { 
        
        count_dist <<- 0
        count_first <<- 0
        count_hsecond <<- 0
        count_second <<- 0
        count_pass <<- 0
        count_atkt <<- 0
        count_fail<-0
        net.sqrt <- neuralnet(Class~Percentage,trainset, hidden=2, threshold = 0.1,stepmax=1e6)
        testset <- Data()$df.raw
        print_test <- subset(testset, select = c("Roll","Name"))
        temp_test <- subset(testset, select = c("Percentage"))
      net.results <- compute(net.sqrt, temp_test) #Run them through the neural network
      
      
      #Lets see what properties net.sqrt has
      #  ls(net.results)
      
      #Lets see the results
      #print(net.results$net.result)
      # gvisTable(as.data.frame(net.results$net.result),options=myOptions())
      #Lets display a better version of the results
      cleanoutput <- cbind(print_test,as.data.frame(net.results$net.result))
      colnames(cleanoutput) <- c("Roll","Name","Predicted_Class")
      
      for(i in 1:Data()$tot)
      {
        if((cleanoutput$Predicted_Class[i])<1.5)
        {
          cleanoutput$Predicted_Class[i]<-"Distinction"
          count_dist <<- count_dist + 1
        }
        else if((cleanoutput$Predicted_Class[i])>1.5 & (cleanoutput$Predicted_Class[i])<2.5 )
        {
          cleanoutput$Predicted_Class[i]<-"First Class"
          count_first <<- count_first + 1
        }
        else if((cleanoutput$Predicted_Class[i])>2.5 & (cleanoutput$Predicted_Class[i])<3.5 )
        {
          cleanoutput$Predicted_Class[i]<-"H.S Class"
          count_hsecond <<- count_hsecond + 1
        }
        else if((cleanoutput$Predicted_Class[i])>3.5 & (cleanoutput$Predicted_Class[i])<4.5 )
        {
          cleanoutput$Predicted_Class[i]<-"Second Class"
          count_second <<- count_second + 1
        }
        else if((cleanoutput$Predicted_Class[i])>4.5 & (cleanoutput$Predicted_Class[i])<5.5 )
        {
          cleanoutput$Predicted_Class[i]<-"Pass Class"
          count_pass <<- count_pass + 1
        }
        else if((cleanoutput$Predicted_Class[i]) > 5.5 & (cleanoutput$Predicted_Class[i])<6.5)
        {
          cleanoutput$Predicted_Class[i]<-"ATKT"
          count_atkt <<- count_atkt + 1
        }
        else if((cleanoutput$Predicted_Class[i]) > 6.5 )
        {
          cleanoutput$Predicted_Class[i]<-"Fail"
          count_fail <<- count_fail + 1
        }
      }
      
      
      value_one<-cleanoutput$Predicted_Class[1]
      for(i in 1:Data()$tot)
      {
        if((cleanoutput$Predicted_Class[i])==value_one)
        {
          flag<<-0
        }
        else
        {
          flag<<-1
          break
        }
      }
      
      }
     
      gvisTable(as.data.frame(cleanoutput),options=list(width="1000px",height="400px"),myOptions())
    
    
   
  })
  
  


 # observeEvent(input$pie,{
    #  if (input$pie) return()
   # else
     # pievalue$click = TRUE
   
  #})
  
  observe({   
    if(input$pie > 0) {
  output$count<-renderPlotly(
    
    {
     # if(pievalue$click==FALSE)return()
     # if(pievalue$click == TRUE){
     
      
      x<-c(count_dist,count_first,count_hsecond,count_second,count_pass,count_atkt,count_fail)
      count<-c(paste("Distinction"),paste("First Class"),paste("Higher Second Class"),paste("Second Class"),paste("Pass Class"),paste("ATKT"),paste("Fail"))
     
      cols<-c("brown2","cadetblue3","hotpink2","chartreuse3","darkseagreen4","peru")   
      pievalue$click = FALSE
      # pie(x, labels = count, main = "Distribution of Students According to Class",col=cols,init.angle =90,radius = 1)
      p <- plot_ly(as.data.frame(x), labels = count, values = x, type = 'pie',textposition = 'inside',
                   textinfo = 'label+percent', showlegend = FALSE) %>%
        layout(title = 'Distribution of Students according to Class',
               xaxis = list(showgrid = FALSE, zeroline = FALSE, showticklabels = FALSE),
               yaxis = list(showgrid = FALSE, zeroline = FALSE, showticklabels = FALSE))
      
      
      }
      
    
  )
    }
})
})
