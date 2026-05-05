# Build and run ASP.NET Core 8 on Linux (works on VPS, Azure, Railway, Fly.io, etc.)
FROM mcr.microsoft.com/dotnet/sdk:8.0 AS build
WORKDIR /src

COPY ["Gharkowebsite.csproj", "."]
RUN dotnet restore "Gharkowebsite.csproj"

COPY . .
RUN dotnet publish "Gharkowebsite.csproj" -c Release -o /app/publish /p:UseAppHost=false --no-restore

FROM mcr.microsoft.com/dotnet/aspnet:8.0 AS final
WORKDIR /app
COPY --from=build /app/publish .

ENV ASPNETCORE_ENVIRONMENT=Production
ENV ASPNETCORE_URLS=http://+:8080
EXPOSE 8080

ENTRYPOINT ["dotnet", "Gharkowebsite.dll"]
